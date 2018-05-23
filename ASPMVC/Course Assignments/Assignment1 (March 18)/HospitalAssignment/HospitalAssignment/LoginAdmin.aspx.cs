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
    public partial class WebForm2 : System.Web.UI.Page
    {
        // get the connection string from the xml
        string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnAdminLogin_Click(object sender, EventArgs e)
        {
            string query = "Select * from Usertbl where Name=@username and Password=@password";
            string username = txtAdminUser.Text.Trim();
            string password = txtAdminPassword.Text.Trim();

            using (SqlConnection con = new SqlConnection(cs))
            {
                con.Open();
                SqlCommand cmd = new SqlCommand(query, con);
                cmd.Parameters.AddWithValue("@username", username);
                cmd.Parameters.AddWithValue("@password", password);

                SqlDataReader rdr = cmd.ExecuteReader();

                if (rdr.Read()) // Checks to see that there is a record
                {
                    Session["Id"] = rdr["Id"]; // Session var for the Id
                    Session["Username"] = rdr["Name"].ToString(); // Session for the name
                    Session["Privilege"] = rdr["Privilege"].ToString(); // Session for the privilege

                    if (Session["Privilege"].ToString() == "admin") // Makes sure that they have the admin privilege
                    {
                        Response.Redirect("~/PortalAdmin.aspx");
                    }
                    else
                    {
                        lblErrorMessage.Text = "<br> Not an admin";
                        lblErrorMessage.BackColor = System.Drawing.Color.Red;
                    }
                }
                else
                {
                    lblErrorMessage.Text = "<br> User or password is incorrect";
                    lblErrorMessage.BackColor = System.Drawing.Color.Red;
                }
            }
        }
    }
}