-- The 2012 dump is double-encoded: UTF-8 text that was read back as MySQL
-- "latin1" (cp1252) and re-encoded as UTF-8, so "Đảo Hải Tặc" is stored as
-- "Äáº£o Háº£i Táº·c". The original app compensated by never calling
-- mysqli_set_charset(), so the browser got the right bytes by accident.
-- includes/config.php now sets utf8, so repair the stored text once here.
-- CONVERT(... USING latin1) recovers the original bytes; BINARY + CONVERT USING
-- utf8 reinterprets them as the UTF-8 they always were.

USE test;

UPDATE cats SET
  name  = CONVERT(BINARY CONVERT(name  USING latin1) USING utf8),
  short = CONVERT(BINARY CONVERT(short USING latin1) USING utf8),
  `long`= CONVERT(BINARY CONVERT(`long` USING latin1) USING utf8);

UPDATE chapter SET
  ngaydang = CONVERT(BINARY CONVERT(ngaydang USING latin1) USING utf8),
  bosung   = CONVERT(BINARY CONVERT(bosung   USING latin1) USING utf8),
  download = CONVERT(BINARY CONVERT(download USING latin1) USING utf8),
  noidung  = CONVERT(BINARY CONVERT(noidung  USING latin1) USING utf8);

UPDATE comments SET
  noidung  = CONVERT(BINARY CONVERT(noidung  USING latin1) USING utf8),
  ngaydang = CONVERT(BINARY CONVERT(ngaydang USING latin1) USING utf8);

UPDATE country SET
  name           = CONVERT(BINARY CONVERT(name           USING latin1) USING utf8),
  printable_name = CONVERT(BINARY CONVERT(printable_name USING latin1) USING utf8);

UPDATE envelope SET
  text = CONVERT(BINARY CONVERT(text USING latin1) USING utf8);

UPDATE manga SET
  name         = CONVERT(BINARY CONVERT(name         USING latin1) USING utf8),
  tenkhac      = CONVERT(BINARY CONVERT(tenkhac      USING latin1) USING utf8),
  namekodau    = CONVERT(BINARY CONVERT(namekodau    USING latin1) USING utf8),
  tenkhackodau = CONVERT(BINARY CONVERT(tenkhackodau USING latin1) USING utf8),
  nguon        = CONVERT(BINARY CONVERT(nguon        USING latin1) USING utf8),
  cats         = CONVERT(BINARY CONVERT(cats         USING latin1) USING utf8),
  congtac      = CONVERT(BINARY CONVERT(congtac      USING latin1) USING utf8),
  chuthich     = CONVERT(BINARY CONVERT(chuthich     USING latin1) USING utf8),
  tacgia       = CONVERT(BINARY CONVERT(tacgia       USING latin1) USING utf8),
  bigimg       = CONVERT(BINARY CONVERT(bigimg       USING latin1) USING utf8),
  smallimg     = CONVERT(BINARY CONVERT(smallimg     USING latin1) USING utf8),
  ngaydang     = CONVERT(BINARY CONVERT(ngaydang     USING latin1) USING utf8);

UPDATE members SET
  username   = CONVERT(BINARY CONVERT(username   USING latin1) USING utf8),
  email      = CONVERT(BINARY CONVERT(email      USING latin1) USING utf8),
  avatar     = CONVERT(BINARY CONVERT(avatar     USING latin1) USING utf8),
  realname   = CONVERT(BINARY CONVERT(realname   USING latin1) USING utf8),
  country    = CONVERT(BINARY CONVERT(country    USING latin1) USING utf8),
  birthday   = CONVERT(BINARY CONVERT(birthday   USING latin1) USING utf8),
  homepage   = CONVERT(BINARY CONVERT(homepage   USING latin1) USING utf8),
  hoppy      = CONVERT(BINARY CONVERT(hoppy      USING latin1) USING utf8),
  occupation = CONVERT(BINARY CONVERT(occupation USING latin1) USING utf8),
  more       = CONVERT(BINARY CONVERT(more       USING latin1) USING utf8),
  cover      = CONVERT(BINARY CONVERT(cover      USING latin1) USING utf8);

UPDATE timezone SET
  name = CONVERT(BINARY CONVERT(name USING latin1) USING utf8);
