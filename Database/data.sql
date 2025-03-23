create Database Online_Voting;

use Online_Voting;


create table users(
SN int primary key auto_increment,
First_Name varchar(50),
Last_Name varchar(50),
Adm_No varchar(20) unique,
Email varchar(50) unique,
Pass varchar(255),
User_Role VARCHAR(255) default 'user',
Reg_Date datetime default now()
);
