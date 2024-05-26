BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "marks" (
	"id"	integer NOT NULL,
	"student_no"	varchar(10) NOT NULL,
	"module_code"	varchar(8) NOT NULL,
	"mark"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "modules" (
	"id"	integer NOT NULL,
	"module_code"	varchar(10) NOT NULL UNIQUE,
	"module_name"	varchar(50) NOT NULL,
	"var_atzimes"	bool NOT NULL,
	"aktivs"	bool NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "students" (
	"id"	integer NOT NULL,
	"surname"	varchar(10) NOT NULL,
	"forename"	varchar(10) NOT NULL,
	"student_no"	varchar(10) NOT NULL,
	"aktivs"	bool NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "django_migrations" (
	"id"	integer NOT NULL,
	"app"	varchar(255) NOT NULL,
	"name"	varchar(255) NOT NULL,
	"applied"	datetime NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "django_session" (
	"session_key"	varchar(40) NOT NULL,
	"session_data"	text NOT NULL,
	"expire_date"	datetime NOT NULL,
	PRIMARY KEY("session_key")
);
CREATE TABLE IF NOT EXISTS "darbinieki_user" (
	"id"	integer NOT NULL,
	"password"	varchar(128) NOT NULL,
	"last_login"	datetime,
	"username"	varchar(255) NOT NULL UNIQUE,
	"is_active"	bool NOT NULL,
	"staff"	bool NOT NULL,
	"admin"	bool NOT NULL,
	"uzvards"	varchar(255) NOT NULL,
	"vards"	varchar(255) NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE UNIQUE INDEX IF NOT EXISTS "modules_id_module_code_0ca248ac_uniq" ON "modules" (
	"id",
	"module_code"
);
CREATE INDEX IF NOT EXISTS "django_session_expire_date_a5c62663" ON "django_session" (
	"expire_date"
);
COMMIT;
