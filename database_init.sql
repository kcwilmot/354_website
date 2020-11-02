drop database if exists biteycat;
create database biteycat;
use biteycat;

create table if not exists users (
	userid int not null auto_increment,
	uname varchar(25) not null,
	password varchar(50) not null,
	fname varchar(50),
	lname varchar(50),
	email varchar(50) not null,
	phone int,
	address varchar(100),
	city varchar(50),
	state varchar(50),
	country varchar(50),
	created_on datetime not null default current_timestamp,
	authlevel int(1) not null default 0,
	constraint users_pk primary key (userid)
	);
    
create table if not exists products (
	productid int not null auto_increment,
	sku varchar(25) not null,
	productname varchar(50) not null,
	categoryid varchar(50),
    description varchar(255),
	instock int(1) not null default 0,
	constraint products_pk primary key (productid)
	);
    
create table if not exists woods (
	woodid int not null auto_increment,
    sku varchar(25) not null,
    woodname varchar(50) not null,
    instock int(1) not null default 0,
    constraint woodtypes_pk primary key (woodid)
    );

create table if not exists finishes (
	finishid int not null auto_increment,
    sku varchar(25) not null,
    finishname varchar(50) not null,
    instock int(1) not null default 0,
    constraint woodtypes_pk primary key (finishid)
    );
    
create table if not exists categories (
	categoryid int not null auto_increment,
    categoryname varchar(50) not null,
    description varchar(255),
    constraint categories_pk primary key (categoryid)
    );
    
create table if not exists catalog (
	catalogid int not null auto_increment,
    productid int not null,
    woodid int not null,
    finishid int not null,
    price decimal(6,3) not null,
    instock int(1) not null default 0,
    constraint catalog_pk primary key (catalogid),
    constraint productid_fk foreign key (productid)
		references products(productid),
	constraint woodid_fk foreign key (woodid)
		references woods(woodid),
	constraint finishid_fk foreign key (finishid)
		references finishes(finishid)
	);
    
create table if not exists shippers (
	shipperid int not null auto_increment,
    shippername varchar(50) not null,
    shipperphone int,
    constraint shipperid_pk primary key (shipperid)
	);
    
create table if not exists orderdetails (
	orderid int not null auto_increment,
    ordernumber int not null,
    catalogid int not null,
    price decimal(6,2) not null,
    quantity int not null,
    total decimal(6,2),
    orderdate datetime default current_timestamp,
    shipdate datetime,
    shipperid int,
    trackingcode varchar(50),
    constraint orderdetails_pk primary key (orderid, ordernumber),
    constraint catalogid_fk foreign key (catalogid)
		references catalog(catalogid),
	constraint shipperid_fk foreign key (shipperid)
		references shippers(shipperid)
	);
    