drop database blog;
create database blog;

grant select, insert, delete, update
on blog.*
to blog_admin identified by 'u3b0pdu4';

use blog;

create table 分类列表 (
    分类编号    int unsigned    not null    primary key, /* 从0开始计数即可 */
	分类标题	varchar(1000),
    描述        blob
);

create table 文章列表 (
    文章编号    bigint unsigned    not null    primary key, /* 编码规则:YYYYMMDDNNNN, Y-年份, M-月份, D-日期, N-文章编号 */
	分类编号	int unsigned,
	发布状态	enum('N', 'Y')    /* 发布则显示最后一版,否则显示倒数第二版 */
);

create table 文章历史表 (
	文章编号    bigint unsigned    not null,
	版本号		int unsigned	not null,	/* 从0开始计数即可 */
	日期		datetime,
	标题		varchar(1000),
	摘要		blob,
	正文_html	longblob,
	正文_md		longblob,
    primary key(文章编号,版本号),
	foreign key 文章列表_fk_1(文章编号) references 文章列表(文章编号) on delete cascade on update cascade
);

create table 标签表 (
	标签名称	varchar(100),
	文章编号	bigint unsigned,
    foreign key 文章列表_fk_1(文章编号) references 文章列表(文章编号) on delete cascade on update cascade
);

/*
create table 物料母子关系表 (
    母件_物料编号   int unsigned    not null,
    子件_物料编号   int unsigned    not null,
    数量            decimal(18,8),
    位置关系        varchar(1000),
    可配置          enum('N','Y'),
    可替换          enum('N','Y'),
    备注            varchar(1000),
    primary key(母件_物料编号,子件_物料编号),
    foreign key 物料目录_fk_1(母件_物料编号) references 物料目录(物料编号) on delete cascade on update cascade,
    foreign key 物料目录_fk_2(子件_物料编号) references 物料目录(物料编号)
);
*/

