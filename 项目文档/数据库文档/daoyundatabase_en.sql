/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2020/3/27 15:10:18                           */
/*==============================================================*/


drop table if exists CheckIn;

drop table if exists Class;

drop table if exists Dictionary;

drop table if exists DictionaryType;

drop table if exists Info;

drop table if exists Menu;

drop table if exists Role;

drop table if exists RoleRight;

drop table if exists StdClass;

drop table if exists User;

drop table if exists UserRight;

drop table if exists UserRole;

/*==============================================================*/
/* Table: CheckIn                                               */
/*==============================================================*/
create table CheckIn
(
   id                   int not null,
   UserId               bigint,
   ClassId              bigint,
   CheckDate            datetime,
   CheckState           int,
   primary key (id)
);

/*==============================================================*/
/* Table: Class                                                 */
/*==============================================================*/
create table Class
(
   ClassId              int not null,
   UserId               bigint,
   ClassNum             int,
   ClassDiscription     varchar(0),
   CreateTime           datetime,
   UpdateTime           datetime,
   LastUpdateUserId     bigint,
   primary key (ClassId)
);

/*==============================================================*/
/* Table: Dictionary                                            */
/*==============================================================*/
create table Dictionary
(
   DictionaryId         int not null,
   UserId               bigint,
   DirctionaryTypeId    int,
   keyword              varchar(0),
   type                 int,
   value                varchar(0),
   discription          varchar(0),
   is_defaule           int,
   create_date          datetime,
   last_update          datetime,
   primary key (DictionaryId)
);

/*==============================================================*/
/* Table: DictionaryType                                        */
/*==============================================================*/
create table DictionaryType
(
   DirctionaryTypeId    int not null,
   name                 varchar(0),
   primary key (DirctionaryTypeId)
);

/*==============================================================*/
/* Table: Info                                                  */
/*==============================================================*/
create table Info
(
   info_id              int not null,
   UserId               bigint,
   RoleId               int,
   info_content         varchar(0),
   type                 int,
   primary key (info_id)
);

/*==============================================================*/
/* Table: Menu                                                  */
/*==============================================================*/
create table Menu
(
   Id                   int not null,
   Right_Key            varchar(255) not null,
   ParentKey            varchar(255),
   Right_Url            varchar(255),
   Right_Name           varchar(255),
   Right_Type           int,
   Right_Status         int,
   SortIndex            int,
   AddTime              datetime,
   LastUpdate           datetime,
   IconUrl              varchar(255),
   AddUser              varchar(255),
   IsDefaultRight       int,
   primary key (Right_Key)
);

/*==============================================================*/
/* Table: Role                                                  */
/*==============================================================*/
create table Role
(
   RoleId               int not null,
   RoleName             varchar(255),
   CreateDate           datetime,
   Creator              varchar(255),
   primary key (RoleId)
);

/*==============================================================*/
/* Table: RoleRight                                             */
/*==============================================================*/
create table RoleRight
(
   id                   int not null,
   Right_Key            varchar(255),
   RoleId               int,
   primary key (id)
);

/*==============================================================*/
/* Table: StdClass                                              */
/*==============================================================*/
create table StdClass
(
   id                   int not null,
   UserId               bigint,
   ClassId              int,
   primary key (id)
);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table User
(
   UserId               bigint not null,
   UserName             varchar(255),
   NickName             varchar(255),
   BornDate             date,
   CountryId            int,
   Address              varchar(255),
   SchoolId             int,
   Phone                bigint,
   UserCode             bigint,
   RealName             varchar(255),
   UserType             int,
   primary key (UserId)
);

/*==============================================================*/
/* Table: UserRight                                             */
/*==============================================================*/
create table UserRight
(
   Right_Key            varchar(255),
   Enable_Flag          int,
   Id                   int not null,
   UserId               bigint,
   primary key (Id)
);

/*==============================================================*/
/* Table: UserRole                                              */
/*==============================================================*/
create table UserRole
(
   Id                   int not null,
   UserId               bigint,
   RoleId               int,
   primary key (Id)
);

alter table CheckIn add constraint FK_Reference_10 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table CheckIn add constraint FK_Reference_11 foreign key (ClassId)
      references Class (ClassId) on delete restrict on update restrict;

alter table Class add constraint FK_Reference_7 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table Dictionary add constraint FK_Reference_14 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table Dictionary add constraint FK_Reference_15 foreign key (DirctionaryTypeId)
      references DictionaryType (DirctionaryTypeId) on delete restrict on update restrict;

alter table Info add constraint FK_Reference_8 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table Info add constraint FK_Reference_16 foreign key (RoleId)
      references Role (RoleId) on delete restrict on update restrict;

alter table RoleRight add constraint FK_Reference_4 foreign key (Right_Key)
      references Menu (Right_Key) on delete restrict on update restrict;

alter table RoleRight add constraint FK_Reference_15 foreign key (RoleId)
      references Role (RoleId) on delete restrict on update restrict;

alter table StdClass add constraint FK_Reference_12 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table StdClass add constraint FK_Reference_13 foreign key (ClassId)
      references Class (ClassId) on delete restrict on update restrict;

alter table UserRight add constraint FK_Reference_1 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table UserRight add constraint FK_Reference_2 foreign key (Right_Key)
      references Menu (Right_Key) on delete restrict on update restrict;

alter table UserRole add constraint FK_Reference_6 foreign key (UserId)
      references User (UserId) on delete restrict on update restrict;

alter table UserRole add constraint FK_Reference_14 foreign key (RoleId)
      references Role (RoleId) on delete restrict on update restrict;

