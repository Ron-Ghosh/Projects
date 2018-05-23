using Periwinkle.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Web;
using System.Web.Mvc;

namespace Periwinkle.Controllers
{
    public class HomeController : Controller
    {
        ContextClass db = new ContextClass();
        // GET: Home
        public ActionResult Index(string SearchBy, string search)
        {
            if (search == null) // If nothing typed in the text box
            {
                return View(db.Books.ToList()); // Get all of the books based on the ID
            }
            else
            {
                if (SearchBy == "Title") // If they checked by the name checkbox
                {
                    return View(db.Books.Where(p => p.Name.Contains(search)).ToList()); // You can use contains or startswith
                }
                else
                {
                    return View(db.Books.Where(p => p.Author.Contains(search)).ToList());
                }
            }
        }

        public ActionResult Login()
        {
            return View();
        }


        [HttpPost]
        public ActionResult Login(string Email, string Password)
        {
            List<User> userList = db.Users.Where(u => u.Email == Email).ToList();

            string convertedPass = CalculateMD5Hash(Password);

            if (userList.Count == 1)
            {
                if (userList[0].Pass_Hash == convertedPass) // if the user and the pass both match the DB
                {
                    Session["UserId"] = userList[0].Id;
                    Session["Name"] = userList[0].First_Name;
                    Session["Email"] = userList[0].Email;
                    Session["Privilege"] = userList[0].Privilege;
                    return RedirectToAction("Index", "Books");
                }
                else
                {
                    ViewBag.LoginMessage = "User or pass incorrect";
                    return View();
                }
            }
            else
            {
                ViewBag.LoginMessage = "No Match";
                return View();
            }
        }

        public ActionResult Register()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Register([Bind(Include = "Id,First_Name,Last_Name,Email,Pass_Hash")] User user)
        {
            // Use request to get the confrim pass and then use viewBag to pass it back to the view
            string confirmPass = Request["Confirm Pass"];

            if (ModelState.IsValid)
            {
                string email = user.Email;
                var previousUser = db.Users.Where(m => m.Email == email).ToList();

                if (previousUser.Count > 0) // if there is already a user with that email
                {
                    ViewBag.Message = "There is a already a user with that email";
                    return View(user);
                }
                else if (confirmPass != user.Pass_Hash)
                {
                    ViewBag.Message = "The passwords do not match";
                    return View(user);
                }

                string pass = user.Pass_Hash;
                string pass_hash = CalculateMD5Hash(pass);
                user.Pass_Hash = pass_hash;
                user.Privilege = "Normal";

                db.Users.Add(user);

                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View();
        }

        public ActionResult Logout()
        {
            Session.Abandon();
            return RedirectToAction("Index");
        }


        public string CalculateMD5Hash(string input)
        {
            // step 1, calculate MD5 hash from input
            MD5 md5 = System.Security.Cryptography.MD5.Create();
            byte[] inputBytes = System.Text.Encoding.ASCII.GetBytes(input);
            byte[] hash = md5.ComputeHash(inputBytes);

            // step 2, convert byte array to hex string
            StringBuilder sb = new StringBuilder();
            for (int i = 0; i < hash.Length; i++)
            {
                sb.Append(hash[i].ToString("X2"));
            }
            return sb.ToString();
        }

    }
}