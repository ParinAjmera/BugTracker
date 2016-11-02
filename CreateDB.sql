#Create tables
Create Table Program2(
Program_Id Int(15) auto_increment Not Null,
Program_Name Varchar(50) Not Null,
Program_Version Int(15) Not Null,
Program_Release Int(15) Not Null,
Primary Key(Program_Id),
Unique (Program_Name, Program_Version, Program_Release)
);

Create Table Area2(
AreaID Int(15) auto_increment Not Null Primary Key,
AreaName Varchar(50) Not Null,
Program_Id Int(15) Not Null,
Foreign Key (Program_Id) References Program2(Program_Id) ON DELETE CASCADE,
UNIQUE KEY(AreaName, Program_Id) 
);

Create Table Employees(
Employee_Id Int(15) auto_increment Not Null,
Employee_Name varchar(50) Not Null unique,
Employee_Password varchar(50) Not Null,
Level_Access varchar(50) Not Null,
Primary Key(Employee_Id)
);

CREATE TABLE bugInfo (bugId int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
summary varchar(100) DEFAULT NULL,
description text NOT NULL,
version int(11) NOT NULL,PgmRel int(11) NOT NULL,
product varchar(10) NOT NULL,
reportedBy varchar(20) NOT NULL,
reportedDate date DEFAULT NULL,
Reproducible tinyint(1) DEFAULT NULL,
StepsToReproduce text,
funcArea varchar(20) DEFAULT NULL,
PgmName varchar(20) DEFAULT NULL,
assignedTo varchar(20) DEFAULT NULL,
status varchar(10) DEFAULT NULL,
resolvedBy varchar(20) DEFAULT NULL,
resolvedDate date DEFAULT NULL,
Severity varchar(15) DEFAULT NULL,
reportType varchar(45) DEFAULT NULL,
suggestedFix text,
modifiedBy varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=big5;