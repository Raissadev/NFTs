PGDMP     /    ,                y            nfts    14.1    14.1 %               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    49215    nfts    DATABASE     d   CREATE DATABASE nfts WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE nfts;
                postgres    false            �            1259    49292    collections    TABLE     �   CREATE TABLE public.collections (
    id integer NOT NULL,
    name character varying(255),
    about text,
    banner character varying(255),
    owners character varying(255),
    nfts character varying(255)
);
    DROP TABLE public.collections;
       public         heap    postgres    false            �            1259    49290    collections_id_seq    SEQUENCE     �   CREATE SEQUENCE public.collections_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.collections_id_seq;
       public          postgres    false    218                       0    0    collections_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.collections_id_seq OWNED BY public.collections.id;
          public          postgres    false    217            �            1259    49264    nfts    TABLE     5  CREATE TABLE public.nfts (
    id integer NOT NULL,
    owner integer NOT NULL,
    shop integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    blockchain character varying(255) NOT NULL,
    image character varying(255),
    price character varying(255) NOT NULL,
    currency character varying(255) NOT NULL,
    crypto_price character varying(255) NOT NULL,
    crypto_type character varying(255) NOT NULL,
    collection integer,
    token character varying(255),
    created_at timestamp with time zone DEFAULT now()
);
    DROP TABLE public.nfts;
       public         heap    postgres    false            �            1259    49263    nfts_id_seq    SEQUENCE     �   CREATE SEQUENCE public.nfts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.nfts_id_seq;
       public          postgres    false    214                       0    0    nfts_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.nfts_id_seq OWNED BY public.nfts.id;
          public          postgres    false    213            �            1259    49285    nfts_purchases    TABLE     v   CREATE TABLE public.nfts_purchases (
    id integer NOT NULL,
    owner integer NOT NULL,
    nft integer NOT NULL
);
 "   DROP TABLE public.nfts_purchases;
       public         heap    postgres    false            �            1259    49284    nfts_purchases_id_seq    SEQUENCE     �   CREATE SEQUENCE public.nfts_purchases_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.nfts_purchases_id_seq;
       public          postgres    false    216                       0    0    nfts_purchases_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.nfts_purchases_id_seq OWNED BY public.nfts_purchases.id;
          public          postgres    false    215            �            1259    49248    shops_vendors    TABLE     �   CREATE TABLE public.shops_vendors (
    id integer NOT NULL,
    owner integer NOT NULL,
    name character varying(255),
    banner character varying(255),
    nfts text
);
 !   DROP TABLE public.shops_vendors;
       public         heap    postgres    false            �            1259    49247    shop_vendor_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shop_vendor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.shop_vendor_id_seq;
       public          postgres    false    212                       0    0    shop_vendor_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.shop_vendor_id_seq OWNED BY public.shops_vendors.id;
          public          postgres    false    211            �            1259    49224    users    TABLE     k  CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    image character varying(255) NOT NULL,
    type_user character varying(255) NOT NULL,
    blockchain character varying(255),
    blockchain_password character varying(255)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    49223    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    210                       0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    209            u           2604    49295    collections id    DEFAULT     p   ALTER TABLE ONLY public.collections ALTER COLUMN id SET DEFAULT nextval('public.collections_id_seq'::regclass);
 =   ALTER TABLE public.collections ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217    218            r           2604    49267    nfts id    DEFAULT     b   ALTER TABLE ONLY public.nfts ALTER COLUMN id SET DEFAULT nextval('public.nfts_id_seq'::regclass);
 6   ALTER TABLE public.nfts ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213    214            t           2604    49288    nfts_purchases id    DEFAULT     v   ALTER TABLE ONLY public.nfts_purchases ALTER COLUMN id SET DEFAULT nextval('public.nfts_purchases_id_seq'::regclass);
 @   ALTER TABLE public.nfts_purchases ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    216    216            q           2604    49251    shops_vendors id    DEFAULT     r   ALTER TABLE ONLY public.shops_vendors ALTER COLUMN id SET DEFAULT nextval('public.shop_vendor_id_seq'::regclass);
 ?   ALTER TABLE public.shops_vendors ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    212    212            p           2604    49227    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209    210                      0    49292    collections 
   TABLE DATA           L   COPY public.collections (id, name, about, banner, owners, nfts) FROM stdin;
    public          postgres    false    218   !)                 0    49264    nfts 
   TABLE DATA           �   COPY public.nfts (id, owner, shop, name, description, blockchain, image, price, currency, crypto_price, crypto_type, collection, token, created_at) FROM stdin;
    public          postgres    false    214   �,                 0    49285    nfts_purchases 
   TABLE DATA           8   COPY public.nfts_purchases (id, owner, nft) FROM stdin;
    public          postgres    false    216   �2       
          0    49248    shops_vendors 
   TABLE DATA           F   COPY public.shops_vendors (id, owner, name, banner, nfts) FROM stdin;
    public          postgres    false    212   3                 0    49224    users 
   TABLE DATA           m   COPY public.users (id, name, email, password, image, type_user, blockchain, blockchain_password) FROM stdin;
    public          postgres    false    210   �4                  0    0    collections_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.collections_id_seq', 17, true);
          public          postgres    false    217                       0    0    nfts_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.nfts_id_seq', 64, true);
          public          postgres    false    213                       0    0    nfts_purchases_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.nfts_purchases_id_seq', 4, true);
          public          postgres    false    215                       0    0    shop_vendor_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.shop_vendor_id_seq', 16, true);
          public          postgres    false    211                        0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 22, true);
          public          postgres    false    209            {           2606    49300    collections collections_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.collections
    ADD CONSTRAINT collections_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.collections DROP CONSTRAINT collections_pkey;
       public            postgres    false    218            y           2606    49271    nfts nfts_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.nfts
    ADD CONSTRAINT nfts_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.nfts DROP CONSTRAINT nfts_pkey;
       public            postgres    false    214            w           2606    49231    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    210               l  x��XMo�6=+��? (~�[�@�M���eH��HT����q׽��ưlH�H��{�$r���a1���G��iƑ�ò�,N�4�%W#�{��`�XיȦ��\v�\[��f�������-���#[8��eE�����4��=;Ls6�[ׅU��<Ƽ#[K�0y��om#���x);'���}��.D�Z!��PvM��/��t����P�ǵ�?F�I��\�;:Zj��;>}���y�3N�<U��~�?��{��iфNK�8�u �Okř��旀P�T�ǀhzo�M}oL�D��(�.�$����#�#��}���~a���a�����B.SaC�8OwX��<��.-����:�����-�9^��nE�h`	B�O�m67����J���au�p�: ن���e1n�Bx'�eC~Y������ل,��0l]�L�!c���<b���&2K�|�E�3�g(g��J�7���F��_q��lm�]2�j.!ǵ���^�a��GbZ�������Ӱ5H?k	G�(���Ķ�Rz�I�F�ۨ$��<�VF��)�R�x�0����������}��Ɋ�!jǍ�c���_��k~,ez���r��A�$�`���:Tx@L	��]>��R�y\����G����������t���I�%��sY�ͧ�:�f2;gnz�=X��G�
Z�h��>
%]H�j�DX�I�:��lM�}I \�D5��{��"�G�;�-�5Ip�mu�jQkM+�?e�����o�Z"{�o7!\���D* z�\O��N��=�b�r~�60��X��[>���kM��=�^m%3�\�Dm�Q��p.����������v         A  x��]��6���_��H~���X`M�M�7{sď	[Yrdi���#�N�NH.�1�X�^R��sHZ����/9�>�C�!E�f��o�u}ڱ�?�;���١wix�B�R�0�cٗC(�KM*��X����]? k��5�N}��CX��k�x��/�0�zlH~��P�绲��&�T�ƦA�1��
��ݬٖC�GG:�xk�0L-,�6H72�¸;`�b!	lH;�bži���5]M=.���MS���}��tgٮk�飣�/��ڋeG��=`;���lj���C�P;M3X�l ��Źc;�XS��Im�-�JJ[2�>�Ǯ�=�1{�����fz�X;�a6��Qrjc���h�����2��\T��	%|ý�s0р�5:��FX�k���	����Mկ������%盟��H�y��ۍ��*ɥ����J�^I��w^(� ���c��n$^#�*I����Dʞ~4$�\�C������DyF�>���rI"l��$X��L�\H|՗�w��kQ`0�~�TR�ഈ^�k)}�U8����\P�3�	�5�OQT��V3����l����[��S��x]4�2�H�v�Z���h���'wN��S풞�������WJ�3rQ- ~����S{���Л�"�k��L�D�U5z-T����,�¡rG�$.![Е�\:;C�'�8RH�%�7
��&"O9f�����B�:��1N�����G�YR2�*\Bh���)^x�g��?���[B�:
-D�V2���	6$'!���m>	��5�K
�V(�-se�Ph�(�S���qx]k=�/��
ϡVV�	�MNE%9����,�k� �-�^p7�� ���[N�J
%O@k$�	<Jy��M*����R�&�)���)Y�B?C��Md�:��M��@�pJ��MK~5*�JΚh��A�wc��O�jaP��\0�̖��rc�l}�Q�'=1���S�@�A"���[KI�L��h";����k�*r	��b%%�<GC}�I���Q��;�|��4x�=)��a2��cz��D��)#
ŝq���
�d�i�)�U�O�W�y��d՚΅U�o����.V-e��|OF�2y�m�a�|�� >�n ��F��sC�2�Z���վ���9�*��$ɷ�m����w0��&�]��AF�,\�HSz�kt.$�6�@�hz5�wr�E:��ȥET�@%��y�^��C�=���� ���`sN���6ɐTtR�Šy����V�]���"�+7e��"3gGz������U�/L�_�&� c@�?	����C����G8���Yո��V��+�b��q4i�}��dm�mX�09JDu�(0:e�u���C�{���Ck�:���Rj�C�ܡ�E�u���MQN��1e�bVF�&S��l���vV��<��ri��*2J8��MlG����n�	^[z���ᢸW�S q����ɢy�bv�lG��>:�&r鐣�T���,I��D5��/X���i��$�����S�u�G뒠1[4M�'��8�V�Gk"��-�(���y���Ջ/�*EKT            x������ � �      
   p  x�]��n�0E��W�lpf��,�ɪYe�CɭL�"_9���A���;܀n^%e����%��t�%�YJm *�ND�v�Eyń������K�q�OW9�|����,��|����lT�l�"�E�S>Ď�ƛ�������~������.bLz�V�Dd)��^����������?��㯥�>%�h]bv�Ĝ���M�D�6�:����k�eƵ$6�3uy�����cPZ�A�q����1=���JK[���v�ҰWN2%���fĢ���Q�,2�S��1^�^���T�y�����t `k�G��Q�C����b�&gYw_Ng?.b�h8d�!p�\L땿�o��n���[         �  x�m��n1Eך��x���s��H��ΆI{�y��&_u�M&��Z�T^\�0!lnf�����yJ��:�����i�2wlM��ST1Y�P����q/.4�\����5���N��d�Z*%���$��Ѹ���P�>�G�0'*�^����%w�eS ��f�́������Z��4m�������/�=;��C�^9�sp�1r J����B�q��V�jz�=}�:�P�f�լ̚��	 f�Н��e�<ԉ���Z�A)��ۗ�0*����[���Q���T����1e	�F���Չ�M�ПNpCQ����0�ΐ��#��G��	���9��jFʉ����u��o(u �c���a�9�m�.m�:��F)n�s=�B�w��S�('��i1�T�Z))���&*�2��.����<Q]v}�m�4�-��C     