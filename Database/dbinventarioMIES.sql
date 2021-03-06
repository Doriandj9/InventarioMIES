PGDMP     ,    5                z            mies_inventario    12.1    12.1                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                        0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            !           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            "           1262    49675    mies_inventario    DATABASE     ?   CREATE DATABASE mies_inventario WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Spain.1252' LC_CTYPE = 'Spanish_Spain.1252';
    DROP DATABASE mies_inventario;
                postgres    false            ?            1259    49694    bienes    TABLE     ^  CREATE TABLE public.bienes (
    codigo bigint NOT NULL,
    descripcion text NOT NULL,
    marca text NOT NULL,
    modelo text NOT NULL,
    serie text NOT NULL,
    color text NOT NULL,
    fecha_fabricacion date NOT NULL,
    estado character(8) NOT NULL,
    observacion text,
    cedula character(10) NOT NULL,
    cantidad integer NOT NULL
);
    DROP TABLE public.bienes;
       public         heap    postgres    false            ?            1259    49692    Bienes_codigo_seq    SEQUENCE     |   CREATE SEQUENCE public."Bienes_codigo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public."Bienes_codigo_seq";
       public          postgres    false    205            #           0    0    Bienes_codigo_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public."Bienes_codigo_seq" OWNED BY public.bienes.codigo;
          public          postgres    false    204            ?            1259    49684    acta    TABLE     ?   CREATE TABLE public.acta (
    codigo_acta character(8) NOT NULL,
    acta_archivo text,
    fecha_creacion timestamp without time zone NOT NULL,
    cedula_receptor character(10) NOT NULL,
    cedula character(10) NOT NULL
);
    DROP TABLE public.acta;
       public         heap    postgres    false            ?            1259    49723    acta_bienes    TABLE     l   CREATE TABLE public.acta_bienes (
    codigo_acta character(8) NOT NULL,
    codigo_bien bigint NOT NULL
);
    DROP TABLE public.acta_bienes;
       public         heap    postgres    false            ?            1259    49676 
   trabajador    TABLE     ?   CREATE TABLE public.trabajador (
    cedula character(10) NOT NULL,
    nombre text NOT NULL,
    apellido text NOT NULL,
    cargo text NOT NULL,
    area text NOT NULL,
    clave text NOT NULL,
    permission integer
);
    DROP TABLE public.trabajador;
       public         heap    postgres    false            ?
           2604    49697    bienes codigo    DEFAULT     p   ALTER TABLE ONLY public.bienes ALTER COLUMN codigo SET DEFAULT nextval('public."Bienes_codigo_seq"'::regclass);
 <   ALTER TABLE public.bienes ALTER COLUMN codigo DROP DEFAULT;
       public          postgres    false    204    205    205                      0    49684    acta 
   TABLE DATA           b   COPY public.acta (codigo_acta, acta_archivo, fecha_creacion, cedula_receptor, cedula) FROM stdin;
    public          postgres    false    203   =                 0    49723    acta_bienes 
   TABLE DATA           ?   COPY public.acta_bienes (codigo_acta, codigo_bien) FROM stdin;
    public          postgres    false    206   Z                 0    49694    bienes 
   TABLE DATA           ?   COPY public.bienes (codigo, descripcion, marca, modelo, serie, color, fecha_fabricacion, estado, observacion, cedula, cantidad) FROM stdin;
    public          postgres    false    205   w                 0    49676 
   trabajador 
   TABLE DATA           ^   COPY public.trabajador (cedula, nombre, apellido, cargo, area, clave, permission) FROM stdin;
    public          postgres    false    202   ?       $           0    0    Bienes_codigo_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public."Bienes_codigo_seq"', 10, true);
          public          postgres    false    204            ?
           2606    49702    bienes Bienes_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.bienes
    ADD CONSTRAINT "Bienes_pkey" PRIMARY KEY (codigo);
 >   ALTER TABLE ONLY public.bienes DROP CONSTRAINT "Bienes_pkey";
       public            postgres    false    205            ?
           2606    49727    acta_bienes acta_bienes_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.acta_bienes
    ADD CONSTRAINT acta_bienes_pkey PRIMARY KEY (codigo_acta, codigo_bien);
 F   ALTER TABLE ONLY public.acta_bienes DROP CONSTRAINT acta_bienes_pkey;
       public            postgres    false    206    206            ?
           2606    49691    acta acta_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.acta
    ADD CONSTRAINT acta_pkey PRIMARY KEY (codigo_acta);
 8   ALTER TABLE ONLY public.acta DROP CONSTRAINT acta_pkey;
       public            postgres    false    203            ?
           2606    49683    trabajador trabajador_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.trabajador
    ADD CONSTRAINT trabajador_pkey PRIMARY KEY (cedula);
 D   ALTER TABLE ONLY public.trabajador DROP CONSTRAINT trabajador_pkey;
       public            postgres    false    202            ?
           2606    49718    bienes ceudula_trabajador    FK CONSTRAINT     ?   ALTER TABLE ONLY public.bienes
    ADD CONSTRAINT ceudula_trabajador FOREIGN KEY (cedula) REFERENCES public.trabajador(cedula) ON UPDATE RESTRICT ON DELETE RESTRICT NOT VALID;
 C   ALTER TABLE ONLY public.bienes DROP CONSTRAINT ceudula_trabajador;
       public          postgres    false    205    2704    202            ?
           2606    49728    acta_bienes codigo_acta    FK CONSTRAINT     ?   ALTER TABLE ONLY public.acta_bienes
    ADD CONSTRAINT codigo_acta FOREIGN KEY (codigo_acta) REFERENCES public.acta(codigo_acta) ON UPDATE RESTRICT ON DELETE RESTRICT;
 A   ALTER TABLE ONLY public.acta_bienes DROP CONSTRAINT codigo_acta;
       public          postgres    false    2706    206    203            ?
           2606    49733    acta_bienes codigo_bien    FK CONSTRAINT     ?   ALTER TABLE ONLY public.acta_bienes
    ADD CONSTRAINT codigo_bien FOREIGN KEY (codigo_bien) REFERENCES public.bienes(codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;
 A   ALTER TABLE ONLY public.acta_bienes DROP CONSTRAINT codigo_bien;
       public          postgres    false    206    205    2708                  x?????? ? ?            x?????? ? ?            x?????? ? ?            x?????? ? ?     