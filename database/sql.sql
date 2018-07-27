create table tbl_user(
	id int not null auto_increment primary key comment 'Khóa chính',
	first_name varchar(50) null comment 'Họ',
	last_name varchar(50) null comment 'Tên',
	email varchar(100) not null comment 'Email',
	phone varchar(15) null comment 'Số điện thoại',
	avatar varchar(255) null comment 'Avatar',
	username varchar(50) not null comment 'Tên đăng nhập',
	password varchar(32) not null comment 'Mật khẩu đăng nhập',
	last_visited date null comment 'Ngày đăng nhập lần cuối',
	deleted_at date null comment 'Đã xóa hay chưa',
	created_by int comment 'Tạo bởi user id nào',
	updated_by int comment 'Cập nhật bởi user id nào',
	created_at date comment 'Tạo vào ngày nào',
	updated_at date comment 'Cập nhật vào ngày nào'
);

create table tbl_category(
	id int not null auto_increment primary key comment 'Khóa chính',
	name varchar(50) null comment 'Tên danh mục',
	slug varchar(50) not null comment 'Slug',
	parent_id int null comment 'Id cha',
	deleted_at date null comment 'Đã xóa hay chưa',
	created_by int comment 'Tạo bởi user id nào',
	updated_by int comment 'Cập nhật bởi user id nào',
	created_at date comment 'Tạo vào ngày nào',
	updated_at date comment 'Cập nhật vào ngày nào'
);

create table tbl_gallery(
	id int not null auto_increment primary key comment 'Khóa chính',
	image varchar(100) null comment 'Url image tương đối: VD /image/test.png',
	title varchar(100) null comment 'Title của image',
	deleted_at date null comment 'Đã xóa hay chưa',
	created_by int comment 'Tạo bởi user id nào',
	updated_by int comment 'Cập nhật bởi user id nào',
	created_at date comment 'Tạo vào ngày nào',
	updated_at date comment 'Cập nhật vào ngày nào'
);

create table tbl_post(
	id int not null auto_increment primary key comment 'Khóa chính',
	title varchar(50) null comment 'Tiêu đề bài viết',
	content text null comment 'Nội dung bài viết',
	id_image int null comment 'Id của hình ảnh đại điện',
	FOREIGN KEY (id_image) REFERENCES tbl_gallery(id),
	deleted_at date null comment 'Đã xóa hay chưa',
	created_by int comment 'Tạo bởi user id nào',
	updated_by int comment 'Cập nhật bởi user id nào',
	created_at date comment 'Tạo vào ngày nào',
	updated_at date comment 'Cập nhật vào ngày nào'
);

create table tbl_category_post(
	id int not null auto_increment primary key comment 'Khóa chính',
	id_category int not null comment 'Id của danh mục',
	id_post int not null comment 'Id của bài post',	
  deleted_at date null comment 'Đã xóa hay chưa',
	created_by int comment 'Tạo bởi user id nào',
	updated_by int comment 'Cập nhật bởi user id nào',
	created_at date comment 'Tạo vào ngày nào',
	updated_at date comment 'Cập nhật vào ngày nào'
	FOREIGN KEY (id_category) REFERENCES tbl_category(id),
	FOREIGN KEY (id_post) REFERENCES tbl_post(id)
);

