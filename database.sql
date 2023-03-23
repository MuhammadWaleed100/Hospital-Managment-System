create database hospital1;

create table employee(
 E_ID varchar(10) primary key, 
 password varchar(40) NOT NULL,
 E_Fname varchar(40) NOT NULL,
 E_Sname varchar(40) NOT NULL,
 E_email varchar(255) NOT NULL,
 E_CNIC varchar(255) not null,
 E_Address varchar(50) not null,
 E_sex varchar(10) NOT NULL,
 E_CNO varchar(30) not null,
 type varchar(40) NOT NULL,
 Esal int not null,
 D_O_J date,
) ;
INSERT INTO employee(E_ID,password,E_Fname,E_Sname,E_email,E_CNIC,E_Address,E_sex,E_CNO,type,Esal,D_O_J)
 VALUES('A1', '105', 'waleed', 'cheema', 'waleedcheema@gmail.com','3410471562815','Gujranwala','Male','03435982548','Admin','10000','');

CREATE TABLE patient (
P_ID int primary key identity(1,1),
fname varchar(100) NOT NULL,
sname varchar(100) NOT NULL,
email varchar(255) NOT NULL,
address varchar(255) NOT NULL,
phone varchar(25) NOT NULL,
sex varchar(10) NOT NULL,
bloodgroup varchar(5) NOT NULL,
birthyear int NOT NULL,
D_O_A date,
) ;

CREATE TABLE doctorreport (
id int NOT NULL identity(1,1),
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
date int NOT NULL,
month int NOT NULL,
year int NOT NULL
) ;

CREATE TABLE medication (
id int primary key NOT NULL identity(1,1),
P_ID int  Foreign Key references patient(P_ID) not null,
status varchar(50) NOT NULL,
symptoms varchar(max) NOT NULL,
tests varchar(max) ,
test_results varchar(max) ,
medical varchar(max) NOT NULL,
doctor_type varchar(20) NOT NULL,
doctor_price int NOT NULL,
test_price int ,
medical_price int NOT NULL,
date int NOT NULL,
month int NOT NULL,
year int NOT NULL
) ;

CREATE TABLE medicine (
id int primary key identity(1,1),
medicine_name varchar(100) NOT NULL,
price int NOT NULL
) ;

create table rooms
(
P_ID int  Foreign Key references patient(P_ID)  null;
room_number int primary key,
room_price int ,
status varchar(10)
);

create table nurse(
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
N_name varchar(50) not null,
);

/*


create table rooms(
R_ID varchar(10) not null,
R_No int not null,
R_type varchar(25) not null,
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
R_cost int not null,
);





create table rooms(
R_ID varchar(10) not null,
R_No int not null,
R_type varchar(25) not null,
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
R_cost int not null,
);


create table records(
R_No int primary key not null identity(1,1),
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
R_details varchar(255) not null,
);


create table bill(
P_ID int  Foreign Key references patient(P_ID) not null,
B_ID int primary key identity(1,1) not null,
--M_id int Foreign Key references medicine(M_id) not null,
Room_Cost	int not null,
Bill_Date	date not null,
Other_Charges varchar(10) not null,
T_Coste int not null,
);

create table lab(
P_ID int  Foreign Key references patient(P_ID) not null,
T_ID int primary key not null identity(1,1),
T_type varchar(50) not null,
T_result varchar(50) not null,
T_cost int not null,
);


create table doctor(
E_ID Varchar(10) Foreign Key references employee(E_ID) not null,
P_ID int  Foreign Key references patient(P_ID) not null,
D_name varchar(50) not null,
D_Sp varchar(50) not null,
);


*/