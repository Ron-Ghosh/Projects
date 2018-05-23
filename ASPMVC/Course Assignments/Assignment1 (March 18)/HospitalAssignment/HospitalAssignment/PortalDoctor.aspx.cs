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

    public partial class PortalDoctor : System.Web.UI.Page
    {
        // get the connection string from the xml
        string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!Page.IsPostBack)
            {
                lblId.Text = Session["Id"].ToString();
                lblDocId.Text = Session["Id"].ToString();

                string doctorQuery = "Select * from Doctortbl where DocId= " + Session["Id"];

                using (SqlConnection con = new SqlConnection(cs))
                {
                    // Write a command
                    SqlCommand cmd = new SqlCommand(doctorQuery, con);

                    con.Open();

                    SqlDataReader reader = cmd.ExecuteReader();

                    if (reader.Read()) // Basically we are getting the doctor information and printing it to the textboxes
                    {
                        txtFirst.Text = reader["First"].ToString();
                        txtLast.Text = reader["Last"].ToString();
                        txtSpecialty.Text = reader["Specialty"].ToString();
                    }
                } // end using


                // This second query takes all the visits from the different patients and prints it out to a label on the html page
                string visitQuery = "Select Name, Date_In, Date_Out, Description from Visittbl join Usertbl on Visittbl.PatientId = Usertbl.Id where Doc_Id= " + Session["Id"];
                using (SqlConnection con2 = new SqlConnection(cs))
                {
                    SqlCommand cmd = new SqlCommand(visitQuery, con2);
                    con2.Open();
                    SqlDataReader reader2 = cmd.ExecuteReader();

                    string visitHistory = string.Empty;

                    while (reader2.Read())
                    {
                        visitHistory += reader2["Name"].ToString() + " || " + reader2["Date_In"].ToString() + " to " + reader2["Date_In"].ToString() + ": " + reader2["Description"].ToString() + "<br>";
                    }

                    lblDescription.Text = visitHistory;
                }
            } // end if postback
        }// end page_load

        protected void btnUpdateDoctor_Click(object sender, EventArgs e)
        {
            string DocFirst = txtFirst.Text;
            string DocLast = txtLast.Text;
            string DocSpecialty = txtSpecialty.Text;

            string updateQuery = "update Doctortbl set First=@First, Last=@Last, Specialty=@Specialty where DocId=@DocId";

            int rowsAffected = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                //update
                SqlCommand cmd = new SqlCommand(updateQuery, con);
                cmd.Parameters.AddWithValue("@First", DocFirst);
                cmd.Parameters.AddWithValue("@Last", DocLast);
                cmd.Parameters.AddWithValue("@Specialty", DocSpecialty);
                cmd.Parameters.AddWithValue("@DocId", Session["Id"].ToString());

                rowsAffected = cmd.ExecuteNonQuery();
            }

            if (rowsAffected == 0) // If there is no previous record 
            {
                updateQuery = "Insert into Doctortbl (DocId, First, Last, Specialty) values (@DocId, @First, @Last, @Specialty)";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();

                    //update
                    SqlCommand cmd = new SqlCommand(updateQuery, con);
                    cmd.Parameters.AddWithValue("@First", DocFirst);
                    cmd.Parameters.AddWithValue("@Last", DocLast);
                    cmd.Parameters.AddWithValue("@Specialty", DocSpecialty);
                    cmd.Parameters.AddWithValue("@DocId", Session["Id"].ToString());

                    rowsAffected = cmd.ExecuteNonQuery();
                }
            }

            lblRows.Text = rowsAffected.ToString() + " row(s) updated";
        }

        protected void btnAddVisit_Click(object sender, EventArgs e)
        {
            string patientId = txtPatientId.Text;
            string docId = lblDocId.Text;
            string dateIn = txtDateIn.Text;
            string dateOut = txtDateOut.Text;
            string description = txtDescription.Text;

            string insertQuery = "insert into Visittbl (PatientId, Doc_Id, Date_In, Date_Out, Description) values (@PatientId, @Doc_Id, @Date_In, @Date_Out, @Description)";

            int rowsInserted = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                // Insert
                SqlCommand cmd = new SqlCommand(insertQuery, con);
                cmd.Parameters.AddWithValue("@PatientId", patientId);
                cmd.Parameters.AddWithValue("@Doc_Id", Session["Id"].ToString());
                cmd.Parameters.AddWithValue("@Date_In", dateIn);
                cmd.Parameters.AddWithValue("@Date_Out", dateOut);
                cmd.Parameters.AddWithValue("@Description", description);

                rowsInserted = cmd.ExecuteNonQuery();
            }

            lblRowsInserted.Text = rowsInserted.ToString() + " row(s) inserted";
        }

        protected void btnBack_Click(object sender, EventArgs e)
        {
            Session.Abandon();
            Response.Redirect("~/Login.aspx");
        }

        protected void btnUpdateMainDoctor_Click(object sender, EventArgs e)
        {
            string patient = txtPatientIdToChange.Text;
            string newMain = txtDoctorIdToChange.Text;

            string mainDocQuery = "update Patienttbl set Main_DocId=@Main_DocId where PatientId=@PatientId";

            int mainDocUpdated = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                // Insert
                SqlCommand cmd = new SqlCommand(mainDocQuery, con);
                cmd.Parameters.AddWithValue("@PatientId", patient);
                cmd.Parameters.AddWithValue("@Main_DocId", newMain);

                mainDocUpdated = cmd.ExecuteNonQuery();
            }

            lblMainDoctorUpdated.Text = mainDocUpdated.ToString() + " row updated";
        }
    } // end class
} // end namespace