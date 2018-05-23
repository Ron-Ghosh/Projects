using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data.SqlClient;
using System.Configuration; // refers to the config file

namespace HospitalAssignment
{
    public partial class PortalPatient : System.Web.UI.Page
    {
        // get the connection string from the xml
        string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!Page.IsPostBack)
            {
                // Based on the login id
                string patientQuery = "Select * from Patienttbl where PatientId= " + Session["Id"]; 

                using (SqlConnection con = new SqlConnection(cs))
                {
                    SqlCommand cmd = new SqlCommand(patientQuery, con);
                    con.Open();
                    SqlDataReader reader = cmd.ExecuteReader();

                    if (reader.Read()) // if the session id is found in the Patienttbl
                    {
                        txtFirst.Text = reader["First"].ToString();
                        txtLast.Text = reader["Last"].ToString();
                        txtCity.Text = reader["City"].ToString();
                        txtRoad.Text = reader["Road"].ToString();
                        txtBirth.Text = reader["Birthday"].ToString();
                        txtGender.Text = reader["Gender"].ToString();
                    }
                }

                // Second query to get their visit history from the visit table
                string visitQuery = "Select Date_In, Date_Out, Description from Visittbl where PatientId= " + Session["Id"];
                using (SqlConnection con2 = new SqlConnection(cs))
                {
                    SqlCommand cmd = new SqlCommand(visitQuery, con2);
                    con2.Open();
                    SqlDataReader reader2 = cmd.ExecuteReader();

                    string visitHistory = string.Empty;

                    while (reader2.Read()) // Basically I pulled all the information into a single string 
                    {
                        visitHistory += reader2["Date_In"].ToString() + " to " + reader2["Date_In"].ToString() + ": " + reader2["Description"].ToString() + "<br>";
                    }

                    lblDescription.Text = visitHistory;
                }
            } // End postback

        }

        protected void btnUpdatePatient_Click(object sender, EventArgs e)
        {
            string newFirst = txtFirst.Text;
            string newLast = txtLast.Text;
            string newCity = txtCity.Text;
            string newRoad = txtRoad.Text;
            string newBirth = txtBirth.Text;
            string newGender = txtGender.Text;

            string updateQuery = "update Patienttbl set First=@First, Last=@Last, City=@City, Road=@Road, Birthday=@Birthday, Gender=@Gender where PatientId=@PatientId";

            int rowsAffected = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                //update
                SqlCommand cmd = new SqlCommand(updateQuery, con);
                cmd.Parameters.AddWithValue("@First", newFirst);
                cmd.Parameters.AddWithValue("@Last", newLast);
                cmd.Parameters.AddWithValue("@City", newCity);
                cmd.Parameters.AddWithValue("@Road", newRoad);
                cmd.Parameters.AddWithValue("@Birthday", newBirth);
                cmd.Parameters.AddWithValue("@Gender", newGender);
                cmd.Parameters.AddWithValue("@PatientId", Session["Id"].ToString());

                rowsAffected = cmd.ExecuteNonQuery();
            }

            if (rowsAffected==0) // if updating for the first time
            {
                // We want them to create a new patient (this will only work if the admin has created them in the user table)
                updateQuery = "insert into Patienttbl (PatientId, Main_DocId, First, Last, City, Road, Birthday, Gender) values (@PatientId, @Main_DocId, @First, @Last, @City, @Road, @Birthday, @Gender)";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();

                    //update
                    SqlCommand cmd = new SqlCommand(updateQuery, con);
                    cmd.Parameters.AddWithValue("@First", newFirst);
                    cmd.Parameters.AddWithValue("@Last", newLast);
                    cmd.Parameters.AddWithValue("@City", newCity);
                    cmd.Parameters.AddWithValue("@Road", newRoad);
                    cmd.Parameters.AddWithValue("@Birthday", newBirth);
                    cmd.Parameters.AddWithValue("@Gender", newGender);
                    cmd.Parameters.AddWithValue("@Main_DocId", 3); 
                    cmd.Parameters.AddWithValue("@PatientId", Session["Id"].ToString());

                    rowsAffected = cmd.ExecuteNonQuery();
                }
            }

            lblRows.Text = rowsAffected.ToString() + " row(s) affected"; // Print message
        }

        // Go back to log in
        protected void btnBack_Click(object sender, EventArgs e)
        {
            Session.Abandon();
            Response.Redirect("~/Login.aspx");
        }

        protected void btnFilterDate_Click(object sender, EventArgs e)
        {
            string visitQuery = "Select Date_In, Date_Out, Description from Visittbl where PatientId= " + Session["Id"] + " and Date_In = '" + txtFilterDate.Text + "'";
            using (SqlConnection con2 = new SqlConnection(cs))
            {
                SqlCommand cmd = new SqlCommand(visitQuery, con2);
                con2.Open();
                SqlDataReader reader2 = cmd.ExecuteReader();

                string visitHistory = string.Empty;

                while (reader2.Read()) // Basically I pulled all the information into a single string 
                {
                    visitHistory += reader2["Date_In"].ToString() + " to " + reader2["Date_In"].ToString() + ": " + reader2["Description"].ToString() + "<br>";
                }

                lblDescription.Text = visitHistory;
            }
        }

        protected void btnViewAll_Click(object sender, EventArgs e)
        {
            string visitQuery = "Select Date_In, Date_Out, Description from Visittbl where PatientId= " + Session["Id"];
            using (SqlConnection con2 = new SqlConnection(cs))
            {
                SqlCommand cmd = new SqlCommand(visitQuery, con2);
                con2.Open();
                SqlDataReader reader2 = cmd.ExecuteReader();

                string visitHistory = string.Empty;

                while (reader2.Read()) // Basically I pulled all the information into a single string 
                {
                    visitHistory += reader2["Date_In"].ToString() + " to " + reader2["Date_In"].ToString() + ": " + reader2["Description"].ToString() + "<br>";
                }

                lblDescription.Text = visitHistory;
            }
        }
    }
}