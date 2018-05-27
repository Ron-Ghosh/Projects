using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using FullStackTest.Models;

namespace FullStackTest.Controllers
{
    public class ClientsController : Controller
    {
        private ContextClass db = new ContextClass();

        public ActionResult Index()
        {
            return View();
        }

        public PartialViewResult All()
        {
            List<CLIENT> model = db.CLIENTs.ToList();
            return PartialView("_Client", model);
        }

        public PartialViewResult Details(int? id)
        {
            CLIENT client = db.CLIENTs.Find(id);
            return PartialView("_Details", client);
        }

        public PartialViewResult Create()
        {
            return PartialView("_Create");
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,First,Last,Email")] CLIENT client)
        {
            db.CLIENTs.Add(client);
            db.SaveChanges();
            List<CLIENT> model = db.CLIENTs.ToList();
            return PartialView("_Client", model);
        }

        public PartialViewResult Edit(int? id)
        {
            CLIENT client = db.CLIENTs.Find(id);
            return PartialView("_Edit",client);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,First,Last,Email")] CLIENT client)
        {
            db.Entry(client).State = EntityState.Modified;
            db.SaveChanges();
            List<CLIENT> model = db.CLIENTs.ToList();
            return PartialView("_Client", model);
        }

        public PartialViewResult Delete(int? id)
        {
            CLIENT client = db.CLIENTs.Find(id);
            return PartialView("_Delete",client);
        }

        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            CLIENT client = db.CLIENTs.Find(id);
            db.CLIENTs.Remove(client);
            db.SaveChanges();
            List<CLIENT> model = db.CLIENTs.ToList();
            return PartialView("_Client", model);
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
