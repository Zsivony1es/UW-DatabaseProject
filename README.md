# CineGalaxy - Database Systems Project
### My project for the 3rd semester Database Systems course at the University of Vienna

#### Contents:
  1. [Introduction](#intro)
  2. [Database](#db)
  3. [Java Program](#jp)
  4. [Website](#ws)
  5. [Closing Thoughts](#ct)

<a name="intro"></a>
## Introduction

Welcome to the GitHub page of my project! What you can find in this repository, is the project I had to complete for the 3rd semester "Database Systems" course at the University of Vienna. Keep in mind, this is the first time I have done anything like this, so if my database layout is not completely logical it's because of that, but I definetly realized some of the problems I had initially and I probably wouldn't make similar mistakes the next time I had to do something similar.\
This project was made up of a couple of different parts. At the beginning of the semester we had to make a concept of a database using an Entity-Relationship model, then reform this diagram to a relational model, and at the end implement this as SQL code. After I had my database ready in SQL, I had to create a Java application, that filled up the relations of the database with semi-random data. Furthermore I also had to create a website using HTML5, CSS and PHP, which is able to access said database and is able to perform Create, Read, Update and Delete operations. [You can reach the website here.](http://wwwlab.cs.univie.ac.at/~peteri00/index.php)\
This website and the database is hosted on the servers of the university (Almighty), and therefore the SQL dialect I had to use was specified by their database, which is Oracle SQL. In the following paragraphs I will describe each section of the project in detail.

<a name="db"></a>
## Database

![ER Model of The Database](https://github.com/Zsivony1es/UW-DatabaseProject/blob/main/ER%20Diagram.png)\
The picture above depicts the initial ER Model of the database in Chen-notation. In the description document you can find the textual description of this model, the transformed relational model and the physical SQL model can be found in `sources/sql`. Running the create script will establish all relations of the database and it also includes a trigger, a couple of views and a generator. This database was hosted on the server of the university for the project.

<a name="jp"></a>
## Java Program

The goal of the Java program was to fill up the relations of the completed database with semi-random data. The files can be found in `sources/java`. In the `resources` folder I have saved some CSV files, that I'm going to be using to create the data I will be inserting into the database. The `src` folder contains the program code.\
To achieve my goal I have created 4 different classes:
  + `DatabaseHelper.java` - Its task is to sustain the communication to the database. Its class methods are performing the data inserts/reads using OJDBC, which is required if you want to run the program yourself!
  + `RandomDataGenerator.java` - This class reads in the CSV files found in resources upon initialization, and an instance can be used to generate fake data for the insertion procedures
  + `TheaterRoom.java` - I had to return a list of the theater rooms I had in the database, therefore I required a class that saved the attributes of a single room.
  + `Main.java` - This is the client. It performs all the insertion operations using the other 3 classes.



<a name="ws"></a>
## Website



<a name="ct"></a>
## Closing Thoughts
