using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Periwinkle.Models;
using System.Web.Helpers;

namespace Periwinkle.Controllers
{
    public class BooksController : Controller
    {
        private ContextClass db = new ContextClass();

        public ActionResult Index(string SearchBy, string search)
        {
            SendEmail((string) Session["Email"], "New Sign In", "You have Signed in");

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

        [HttpPost]
        public JsonResult Index(string Prefix)
        {
            List<Book> bookList = db.Books.ToList();

            //Searching records from list using LINQ query  
            var BookList = (from N in bookList
                            where N.Name.StartsWith(Prefix)
                            select new { N.Name });
            return Json(BookList, JsonRequestBehavior.AllowGet);
        }

        // GET: Books/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Book book = db.Books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // GET: Books/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Books/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Name,Author,Copies")] Book book)
        {
            if (ModelState.IsValid)
            {
                db.Books.Add(book);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(book);
        }

        // GET: Books/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Book book = db.Books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // POST: Books/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Name,Author,Copies")] Book book)
        {
            if (ModelState.IsValid)
            {
                db.Entry(book).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(book);
        }

        // GET: Books/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Book book = db.Books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // POST: Books/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Book book = db.Books.Find(id);
            db.Books.Remove(book);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        public ActionResult ReviewList(int? id)
        {
            List<Review> rList = db.Reviews.Where(b => b.Book_Id == id).ToList();
            return View(rList);
        }

        public ActionResult CreateReview(int id)
        {
            List<Book> bookList = db.Books.Where(b => b.Id == id).ToList();

            ViewBag.BookName = bookList[0].Name;
            Session["BookName"] = bookList[0].Name; // needed for when we get back to the post version of this method
            ViewBag.ReviewerName = Session["Name"];

            //ViewBag.Book_Id = new SelectList(db.Books, "Id", "Name");
            //ViewBag.User_Id = new SelectList(db.Users, "Id", "First_Name");

            return View();
        }

        [HttpPost]
        public ActionResult CreateReview(string Review)
        {
            Review rev = new Review();

            string email = (string)Session["Email"];
            List<User> ul = db.Users.Where(u => u.Email == email).ToList();

            rev.User_Id = ul[0].Id;

            string book = (string)Session["BookName"];
            List<Book> bl = db.Books.Where(b => b.Name == book).ToList();

            rev.Book_Id = bl[0].Id;

            rev.Review1 = Review;

            db.Reviews.Add(rev);
            db.SaveChanges();

            return RedirectToAction("Index");
        }

        public ActionResult Rental(int id)
        {
            List<Book> bookList = db.Books.Where(b => b.Id == id).ToList();

            if (bookList[0].Copies > 0) // if there are copies left in the bookstore
            {
                ViewBag.BookName = bookList[0].Name;
                Session["BookName"] = bookList[0].Name; // needed for when we get back to the post version of this method
                ViewBag.RenterName = Session["Name"];

                return View();
            }

            return RedirectToAction("Index");
        }

        [HttpPost]
        public ActionResult Rental()
        {
            Rental rental = new Rental();

            // Find the user id based on the session email
            string email = (string)Session["Email"];
            List<User> ul = db.Users.Where(u => u.Email == email).ToList();

            // Set the id = to the rental user id
            rental.User_Id = ul[0].Id;

            // Find the book id based on the session book name (which is created when you click the link)
            string book = (string)Session["BookName"];
            List<Book> bl = db.Books.Where(b => b.Name == book).ToList();

            // set the rental book id = to the book id
            rental.Book_Id = bl[0].Id;

            // Set the sign out and the return date
            rental.Sign_Out_Date = DateTime.Now;
            rental.Return_Date = DateTime.Now.AddDays(7);

            // Remove a copy
            bl[0].Copies = bl[0].Copies - 1;

            db.Rentals.Add(rental);
            db.SaveChanges();

            string emailMessage = "You have rented " + book + " and it will be due " + DateTime.Now.AddDays(7).ToString();

            SendEmail(email, "New Rental", emailMessage);

            return RedirectToAction("Index");
        }

        public ActionResult UserProfile() // from the _Layout page
        {
            int idToCheck = (int)Session["UserId"];

            List<string> ProfileInformation = new List<string>();

            // first name, last name and email
            List<User> ul = db.Users.Where(u => u.Id == idToCheck).ToList();
            User selectedUser = ul[0];

            // Add to the list
            ProfileInformation.Add(ul[0].First_Name.ToString());
            ProfileInformation.Add(ul[0].Last_Name.ToString());
            ProfileInformation.Add(ul[0].Email.ToString());

            // Rentals
            List<Rental> rentalList = db.Rentals.Where(u => u.User_Id == idToCheck).ToList();

            foreach (Rental x in rentalList)
            {
                List<Book> bookList = db.Books.Where(b => b.Id == x.Book_Id).ToList();
                string name = bookList[0].Name;
                ProfileInformation.Add(name);
            }

            Session["ProfileInfo"] = ProfileInformation;


            return View();
        }

        public ActionResult ReturnBook(string name) // name of the book that we want to return
        {
            List<Book> bl = db.Books.Where(b => b.Name == name).ToList();

            // Create the book object
            Book book = db.Books.Find(bl[0].Id);

            // increase the copies by 1
            book.Copies = book.Copies + 1;

            // find the rental with the session's user ID and the book id
            int userId = (int)Session["UserId"];
            int bookId = bl[0].Id;

            List<Rental> rl = db.Rentals.Where(r => r.User_Id == userId).Where(r => r.Book_Id == bookId).ToList();
            Rental rental = rl[0];

            db.Rentals.Remove(rental);
            db.SaveChanges();

            return RedirectToAction("Index");
        }


        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        public void SendEmail(string emailTo, string subjectTo, string message)
        {
            try
            {
                //Configuring webMail class to send emails  
                //gmail smtp server  
                WebMail.SmtpServer = "smtp.gmail.com";
                //gmail port to send emails  
                WebMail.SmtpPort = 587;
                WebMail.SmtpUseDefaultCredentials = true;
                //sending emails with secure protocol  
                WebMail.EnableSsl = true;
                //EmailId used to send emails from application  
                WebMail.UserName = "S3Humber2018@gmail.com";
                WebMail.Password = "ronandfred";

                //Sender email address.  
                WebMail.From = "S3Humber2018@gmail.com";

                //Send email

                WebMail.Send(emailTo, subjectTo, message, WebMail.UserName);
                ViewBag.Status = "Email Sent Successfully.";
            }
            catch (Exception)
            {
                ViewBag.Status = "Problem while sending email, Please check details.";

            }
        }
    }
}
