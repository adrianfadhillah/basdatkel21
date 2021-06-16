-- Database: db_jual_ternak

-- DROP DATABASE db_jual_ternak;

CREATE DATABASE db_jual_ternak
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_United States.1252'
    LC_CTYPE = 'English_United States.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- Table: public.data_order

-- DROP TABLE public.data_order;

CREATE TABLE public.data_order
(
    nik character varying(50) COLLATE pg_catalog."default",
    jumlah_order integer,
    total_pembayaran integer,
    tanggal_order date,
    id_hewan character varying(50) COLLATE pg_catalog."default",
    id_toko character varying(50) COLLATE pg_catalog."default",
    id_order integer NOT NULL DEFAULT nextval('data_order_id_order_seq'::regclass),
    CONSTRAINT data_order_pkey PRIMARY KEY (id_order),
    CONSTRAINT id_hewan FOREIGN KEY (id_hewan)
        REFERENCES public.data_ternak (id_hewan) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT id_toko FOREIGN KEY (id_toko)
        REFERENCES public.data_penjual (id_toko) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT nik FOREIGN KEY (nik)
        REFERENCES public.data_pembeli (nik) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE public.data_order
    OWNER to postgres;

-- Table: public.data_pembeli

-- DROP TABLE public.data_pembeli;

CREATE TABLE public.data_pembeli
(
    nik character varying(50) COLLATE pg_catalog."default" NOT NULL,
    nama_pembeli character varying(50) COLLATE pg_catalog."default",
    alamat_pembeli character varying(50) COLLATE pg_catalog."default",
    no_hp character varying(50) COLLATE pg_catalog."default",
    email_pembeli character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT data_pembeli_pkey PRIMARY KEY (nik)
)

TABLESPACE pg_default;

ALTER TABLE public.data_pembeli
    OWNER to postgres;

-- Table: public.data_penjual

-- DROP TABLE public.data_penjual;

CREATE TABLE public.data_penjual
(
    id_toko character varying(50) COLLATE pg_catalog."default" NOT NULL,
    nama_toko character varying(50) COLLATE pg_catalog."default",
    alamat_toko character varying(50) COLLATE pg_catalog."default",
    no_telp character varying(50) COLLATE pg_catalog."default",
    email character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT data_penjual_pkey PRIMARY KEY (id_toko),
    CONSTRAINT id_toko FOREIGN KEY (id_toko)
        REFERENCES public.data_penjual (id_toko) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE public.data_penjual
    OWNER to postgres;

-- Table: public.data_ternak

-- DROP TABLE public.data_ternak;

CREATE TABLE public.data_ternak
(
    id_hewan character varying(50) COLLATE pg_catalog."default" NOT NULL,
    nama_hewan character varying(50) COLLATE pg_catalog."default",
    jenis_hewan character varying(50) COLLATE pg_catalog."default",
    kategori_berat character varying(50) COLLATE pg_catalog."default",
    harga_hewan integer,
    id_toko character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT data_ternak_pkey PRIMARY KEY (id_hewan)
)

TABLESPACE pg_default;

ALTER TABLE public.data_ternak
    OWNER to postgres;

-- SEQUENCE: public.data_order_id_order_seq

-- DROP SEQUENCE public.data_order_id_order_seq;

CREATE SEQUENCE public.data_order_id_order_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 2147483647
    CACHE 1;

ALTER SEQUENCE public.data_order_id_order_seq
    OWNER TO postgres;