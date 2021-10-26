Create DATABASE solarpv;

create table Client(
    clientid int NOT NULL AUTO_INCREMENT,
    clientname varchar(255),
	clienttype varchar(255)
	PRIMARY KEY(clientid)	
     );
create table user(
clientid int,
userid varchar(255),
firstname varchar(255),
middlename varchar(255),
lastname varchar(255),
jobtitle varchar(30),
email varchar(255),
ophone int(10),
cphone int(10),
prefix varchar(10),
PRIMARY KEY (userid),
FOREIGN KEY(clientid) REFERENCES Client(clientid)

);

create table location(
locationid int(9),
address varchar(255),
city varchar(255),
state varchar(2),
postal int(10),
country varchar(255),
clientid int,
PRIMARY KEY (locationid),
FOREIGN KEY(clientid) REFERENCES Client(clientid)
);

create table standard(
    standardid int,
    standardname varchar(255),
	description TEXT, 
	pub DATE,
	PRIMARY KEY(standardid)	
     );

create table product(
modelnum varchar(255),
pname varchar(255),
celltech varchar(255),
cellman varchar(255),
numcels int,
cellseries int,
numdio int,
len int,
width int,
weight int,
superstate varchar(255),
superman varchar(255),
substratetype varchar(255),
subman varchar(255),
frametype varchar(255),
frameadhesive varchar(255),
encapsulate varchar(255),
encapman varchar(255),
junctionboxtype varchar(255),
junctionboxman varchar(255),
PRIMARY KEY(modelnum)
);

create table service(
serviceid int,
servicename varchar(255),
flreq varchar(3),
flfeq varchar(255),
standardid int,
PRIMARY KEY(serviceid),
FOREIGN KEY(standardid) REFERENCES standard (standardid)

);

create table certificate(
certnum int NOT NULL AUTO_INCREMENT,
userid varchar(255),
reportnum int(15),
issuedate DATE,
standardid int,
locationid int,
modelnum varchar(255),
PRIMARY KEY (certnum),
FOREIGN KEY(standardid) REFERENCES standard (standardid),
FOREIGN KEY(locationid) REFERENCES location(locationid),
FOREIGN KEY(modelnum) REFERENCES product (modelnum),
FOREIGN KEY(userid) REFERENCES user (userid)
);

create table testsequence(
sequenceid varchar (255),
sequencename varchar (255),
PRIMARY KEY (sequenceid)
);

create table performance(
modelnum varchar(255),
sequenceid varchar(255),
maxvolt DECIMAL(4,3),
voc decimal(4,3),
isc decimal(4,3),
vmp decimal(4,3),
imp decimal(4,3),
pmp decimal(4,3),
ff decimal(4,3),
FOREIGN KEY(modelnum) REFERENCES product (modelnum),
FOREIGN KEY(sequenceid) REFERENCES testsequence (sequenceid)
);

ALTER TABLE client AUTO_INCREMENT=100000;
ALTER TABLE certnum AUTO_INCREMENT=100;

INSERT INTO product (modelnum,celltech,cellman,numcels,cellseries,numdio,len,width,weight,superstate,superman,substratetype,subman,frametype,frameadhesive,encapsulate,encapman,junctionboxtype,junctionboxman)
VALUES('KUT0012','mono-si','motech','72','72','3','158','80','15','Tempered Glass','Dongguan','TPT','ISOVOLTA','Aluminum alloy', 'Dow Corning', 'EVA','Bridge Stone Corporation','PV-RH0502B','Cixi Renhe');

INSERT INTO testsequence(sequenceid,sequencename)
VALUES('Test1','Baseline');

INSERT INTO performance(modelnum, sequenceid, maxvolt, voc,isc,vmp,imp,pmp,ff)
VALUES('KUT0012','Test1','1000','44.7','5.2','35.7','4.88','174.3','75');