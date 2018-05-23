using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using WebApplication2.Models;

namespace WebApplication2.Controllers
{
    public class booksController : Controller
    {
        private ModelContext db = new ModelContext();

        // GET: books
        public ActionResult Index(string SearchBy, string search)
        {
            if (search == null) // If nothing typed in the text box
            {
                return View(db.books.ToList()); // Get all of the books based on the ID
            }
            else
            {
                if (SearchBy == "Name") // If they checked by the name checkbox
                {
                    return View(db.books.Where(p => p.Name.Contains(search)).ToList()); // You can use contains or startswith
                }
                else
                {
                    return View(db.books.Where(p => p.Author.Contains(search)).ToList());
                }
            }

        }

        // Listing out the books based on author
        // Use the list template when creating the view
        public ActionResult OrderBooksByAuthor(string SearchBy, string search)
        {
            var books = from b in db.books
                        orderby b.Author ascending
                        select b;

            if (search == null) // If nothing typed in the text box
            {
                return View(db.books.ToList()); // Get all of the books based on the ID
            }
            else
            {
                if (SearchBy == "Name") // If they checked by the name checkbox
                {
                    return View(db.books.Where(p => p.Name.Contains(search)).ToList()); // You can use contains or startswith
                }
                else
                {
                    return View(db.books.Where(p => p.Author.Contains(search)).ToList());
                }
            }
            //return View(books);
        }

        // Listing out the books based on author
        // Use the list template when creating the view
        public ActionResult OrderBooksByTitle()
        {
            var books = from b in db.books
                        orderby b.Name ascending
                        select b;
            return View(books);
        }

        // GET: books/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            book book = db.books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // GET: books/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: books/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Name,Author,copies")] book book)
        {
            if (ModelState.IsValid)
            {
                db.books.Add(book);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(book);
        }

        // GET: books/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            book book = db.books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // POST: books/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Name,Author,copies")] book book)
        {
            if (ModelState.IsValid)
            {
                db.Entry(book).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(book);
        }

        // GET: books/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            book book = db.books.Find(id);
            if (book == null)
            {
                return HttpNotFound();
            }
            return View(book);
        }

        // POST: books/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            book book = db.books.Find(id);
            db.books.Remove(book);
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

        


    }
}
