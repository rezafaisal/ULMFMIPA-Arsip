ALTER TABLE users ADD nip VARCHAR(25);

ALTER TABLE arsip ADD kategori_id INT;
ALTER TABLE arsip ADD bidang_id INT;

drop table if exists arsip_viewers;

/*==============================================================*/
/* Table: arsip_viewers                                         */
/*==============================================================*/
create table arsip_viewers
(
   arsip_viewers_id     bigint not null,
   arsip_id             int,
   username             varchar(50),
   nip                  varchar(25),
   bidang_id            int,
   is_uploader          tinyint,
   primary key (arsip_viewers_id)
);

