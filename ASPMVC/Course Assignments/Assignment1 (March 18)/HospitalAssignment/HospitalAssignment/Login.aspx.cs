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
    public partial class WebForm1 : System.Web.UI.Page
    {
        // get the connection string from the xml
        string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnLogin_Click(object sender, EventArgs e)
        {
            // Takes the inputs to run the query
            string query = "Select * from Usertbl where Name=@username and Password=@password";
            string username = txtUser.Text.Trim();
            string password = txtpass.Text.Trim();

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();
                SqlCommand cmd = new SqlCommand(query, con);
                cmd.Parameters.AddWithValue("@username", username);
                cmd.Parameters.AddWithValue("@password", password);

                // for select statements use ExecuteReader()
                SqlDataReader rdr = cmd.ExecuteReader();

                if (rdr.Read()) // Checks to make sure that the user is found in the Usertbl
                {
                    Session["Id"] = rdr["Id"]; // Session var for the Id
                    Session["Username"] = rdr["Name"].ToString(); // Session for the name
                    Session["Privilege"] = rdr["Privilege"].ToString(); // Session for the privilege

                    // Redirects them to the correct portal based on their privilege
                    if (Session["Privilege"].ToString() == "patient")
                    {
                        Response.Redirect("~/PortalPatient.aspx");
                    }
                    else if (Session["Privilege"].ToString() == "doctor")
                    {
                        Response.Redirect("~/PortalDoctor.aspx");
                    }
                }
                else
                {
                    // Error message if not found in the Usertbl
                    lblErrorMessage.Text = "<br> User or password is incorrect";
                    lblErrorMessage.BackColor = System.Drawing.Color.Red;
                }
            }
        }
    }
}