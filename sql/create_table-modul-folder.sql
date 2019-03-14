drop table if exists folder;

/*==============================================================*/
/* Table: folder                                                */
/*==============================================================*/
create table folder
(
   folder_id            int not null,
   parent_id            int,
   pemilik_id           int,
   nama                 varchar(255),
   tgl_buat             datetime,
   no_urut              int,
   primary key (folder_id)
);

drop table if exists folder_viewer;

/*==============================================================*/
/* Table: folder_viewer                                         */
/*==============================================================*/
create table folder_viewer
(
   folder_id            int not null,
   viewer_id            int not null,
   primary key (folder_id, viewer_id)
);

drop table if exists arsip_in_folder;

/*==============================================================*/
/* Table: arsip_in_folder                                       */
/*==============================================================*/
create table arsip_in_folder
(
   folder_id            int not null,
   arsip_id             int not null,
   no_urut              int,
   primary key (folder_id, arsip_id)
);