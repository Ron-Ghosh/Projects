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
    public partial class PortalAdmin : System.Web.UI.Page
    {

        // get the connection string from the xml
        string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
        protected void Page_Load(object sender, EventArgs e)
        {
            // They don't need to do anything on load
        }

        // This method finds users (like the lab we did previously)
        protected void btnLoadInfo_Click(object sender, EventArgs e)
        {
            string adminQuery = "Select * from Usertbl where id=" + txtId.Text; 

            using (SqlConnection con = new SqlConnection(cs))
            {
                // Write a command
                SqlCommand cmd = new SqlCommand(adminQuery, con);
                con.Open();
                SqlDataReader reader = cmd.ExecuteReader();

                if (reader.Read())
                {
                    txtName.Text = reader["Name"].ToString();
                    txtPass.Text = reader["Password"].ToString();
                    txtPrivilege.Text = reader["Privilege"].ToString();
                    lblRecord.Text = "";
                }
                else
                {
                    lblRecord.Text = "No Records Found";
                }
            }
        }

        // Takes the information from the textboxes and sets the values in the user table
        protected void btnUpdate_Click(object sender, EventArgs e)
        {
            string IdForWhereClause = txtId.Text;
            string newName = txtName.Text;
            string newPass = txtPass.Text;
            string newPrivilege = txtPrivilege.Text;

            string updateQuery = "update Usertbl set Name=@Name, Password=@Password, Privilege=@Privilege where Id=@Id";

            int rowsAffected = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                //update
                SqlCommand cmd = new SqlCommand(updateQuery, con);
                cmd.Parameters.AddWithValue("@Name", newName);
                cmd.Parameters.AddWithValue("@Password", newPass);
                cmd.Parameters.AddWithValue("@Privilege", newPrivilege);
                cmd.Parameters.AddWithValue("@Id", IdForWhereClause);

                rowsAffected = cmd.ExecuteNonQuery();
            }

            lblRecord.Text = rowsAffected.ToString() + " row(s) updated";
        }

        protected void btnInsert_Click(object sender, EventArgs e)
        {
            string newName = txtName.Text;
            string newPass = txtPass.Text;
            string newPrivilege = txtPrivilege.Text;

            string insertQuery = "Insert into Usertbl (Name, Password, Privilege) values (@Name, @Password, @Privilege)";

            int rowsAffected = 0;

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();

                //update
                SqlCommand cmd = new SqlCommand(insertQuery, con);
                cmd.Parameters.AddWithValue("@Name", newName);
                cmd.Parameters.AddWithValue("@Password", newPass);
                cmd.Parameters.AddWithValue("@Privilege", newPrivilege);

                rowsAffected = cmd.ExecuteNonQuery();
            }

            lblRecord.Text = rowsAffected.ToString() + " row(s) inserted";
        }

        // This delete was a little tough because I had to delete them from the users table and either the doctor or the patient table
        protected void btnDelete_Click(object sender, EventArgs e)
        {
            string IdToDelete = txtId.Text;
            string checkPrivilege = txtPrivilege.Text;

            string deleteQuery = "";
            int rowsAffected = 0;

            if (checkPrivilege == "patient")
            {
                deleteQuery = "delete from Patienttbl where PatientId=@PatientId";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();
                    //update
                    SqlCommand cmd = new SqlCommand(deleteQuery, con);
                    cmd.Parameters.AddWithValue("@PatientId", IdToDelete);
                    cmd.ExecuteNonQuery();
                }

                deleteQuery = "delete from Usertbl where Id=@Id";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();
                    //update
                    SqlCommand cmd = new SqlCommand(deleteQuery, con);
                    cmd.Parameters.AddWithValue("@Id", IdToDelete);
                    rowsAffected = cmd.ExecuteNonQuery();
                }

                lblRecord.Text = rowsAffected.ToString() + " row(s) updated";
            }
            else if (checkPrivilege == "doctor")
            {
                deleteQuery = "delete from Doctortbl where DocId=@DocId";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();
                    //update
                    SqlCommand cmd = new SqlCommand(deleteQuery, con);
                    cmd.Parameters.AddWithValue("@DocId", IdToDelete);
                    cmd.ExecuteNonQuery();
                }

                deleteQuery = "delete from Usertbl where Id=@Id";

                using (SqlConnection con = new SqlConnection(cs))
                {
                    con.Open();
                    //update
                    SqlCommand cmd = new SqlCommand(deleteQuery, con);
                    cmd.Parameters.AddWithValue("@Id", IdToDelete);
                    rowsAffected = cmd.ExecuteNonQuery();
                }

                lblRecord.Text = rowsAffected.ToString() + " row(s) updated";
            }
        }

        protected void btnBack_Click(object sender, EventArgs e)
        {
            Session.Abandon();
            Response.Redirect("~/Login.aspx");
        }
    }
}