This is the order to take a look at the code. In order to properly login, please refer to the user table; I've created a few separate users with different privileges that will redirect you to the different portals.

	1. Assignment.Master
	2. Login
	3. PortalPatient
	4. PortalDoctor
	5. LoginAdmin
	6. PortalAdmin

Most of the functionality is there, but it's a little bit unorthodox because I have a user table, as well as a separate table based on whether you are a doctor, patient, or admin. 

For the most part it's pretty much the same, but for the admin portal it becomes a little bit tricky because you have to insert into the users table, and then check the privilege, and then insert a record into either the doctor or patient table. Similarly, when deleting, I have to delete from the patient or doctor table first (because of the foreign key) and then delete from the user table. 

When creating a user, the main doctor is automatically assigned. And then the doctor can go into their own portal and change it if they want. Similarly, when a new users created, their personal information will be blank the first time, so they can login and add their information.

I would say for the next time it would be better if we got a clearer idea of what to put in to all of the SQL tables, or if we were given some sort of database schema to begin with. 
