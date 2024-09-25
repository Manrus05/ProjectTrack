create database projfortschritt;

use projfortschritt;

create table project(
    id int not null primary key auto_increment,
    titel varchar(30) not null,
    grad int not null,
    deadlein date not null default current_date(),
    maxstunden int not null
);

create table mitarbeiter_stunden(
    id int not null primary key auto_increment,
    projectid int not null,
    nutzername varchar(30) not null,
    stunden int not null,
    foreign key(projectid) references project(id)
);