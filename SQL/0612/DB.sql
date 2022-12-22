create table if not exists brand
(
    id          bigint auto_increment
        primary key,
    name        varchar(250) charset utf8             not null,
    description varchar(2000) charset utf8 default '' null,
    slug        varchar(250) charset utf8             not null
)
    comment 'product brand';

create table if not exists category
(
    id          bigint auto_increment
        primary key,
    name        varchar(250) charset utf8  not null,
    description varchar(2000) charset utf8 null,
    slug        varchar(250) charset utf8  not null
)
    comment 'product brand';

create table if not exists customer
(
    id             bigint auto_increment
        primary key,
    name           varchar(250) charset utf8                                null,
    phone_number   varchar(11) charset utf8                                 null,
    email          varchar(250) charset utf8                                not null,
    password       varchar(250) charset utf8                                not null,
    description    varchar(2000) charset utf8 default ''                    null,
    gender         tinyint                    default -1                    null,
    address        varchar(250) charset utf8  default ''                    null,
    avatar         varchar(250) charset utf8  default 'admin_default.png'   null,
    created_at     datetime                   default '2022-10-10 00:00:00' not null,
    updated_at     timestamp                  default '2022-10-10 00:00:00' not null,
    status         tinyint                    default 1                     null comment '0: disabled
1: enabled',
    remember_token varchar(100) charset utf8  default ''                    not null
)
    comment 'customer account';

create table if not exists option_group
(
    id         bigint auto_increment
        primary key,
    name       varchar(250) charset utf8 default ''                    not null,
    created_at datetime                  default '2022-10-10 00:00:00' not null,
    updated_at timestamp                 default '2022-10-10 00:00:00' not null
)
    comment 'product option group ( size, shoe accessories )';

create table if not exists `option`
(
    id              bigint auto_increment
        primary key,
    name            varchar(250) charset utf8 default '' not null,
    value           varchar(250) charset utf8 default '' not null,
    id_option_group bigint                               not null,
    bonus           int                       default 0  not null,
    constraint option_fk_option_group
        foreign key (id_option_group) references option_group (id)
            on delete cascade
);

create table if not exists `order`
(
    id           bigint auto_increment
        primary key,
    id_customer  bigint                                                   not null,
    total        bigint                     default 0                     not null,
    created_at   datetime                   default '2022-10-10 00:00:00' not null,
    updated_at   datetime                   default '2022-10-10 00:00:00' not null,
    status       tinyint                    default 0                     not null comment '0: Chưa thanh toán
1: Đã thanh toán
2: Thành công
Không quản lý giai đoạn vận chuyển',
    address      varchar(250) charset utf8                                not null,
    phone_number varchar(11) charset utf8                                 not null,
    note         varchar(2000) charset utf8 default ''                    not null,
    constraint order_fk_customer
        foreign key (id_customer) references customer (id)
);

create table if not exists product
(
    id          bigint auto_increment
        primary key,
    name        varchar(250) charset utf8                                not null,
    slug        varchar(250) charset utf8                                not null,
    description varchar(2000) charset utf8 default ''                    not null,
    price       int                                                      not null,
    discount    int                        default 0                     not null,
    created_at  datetime                   default '2022-10-10 00:00:00' not null,
    updated_at  timestamp                  default '2022-10-10 00:00:00' not null,
    start_at    datetime                   default '2022-10-10 00:00:00' not null comment 'time start discount',
    end_at      datetime                   default '2022-10-10 00:00:00' not null,
    thumbnail   varchar(250) charset utf8  default 'product_default.png' not null,
    status      tinyint                    default 1                     not null comment '0: disabled
1: enabled
3: sold out',
    id_brand    bigint                                                   not null,
    id_category bigint                                                   not null,
    constraint product_slug_uindex
        unique (slug),
    constraint product_fk_brand
        foreign key (id_brand) references brand (id),
    constraint product_fk_category
        foreign key (id_category) references category (id)
);

create table if not exists product_image
(
    id         bigint auto_increment
        primary key,
    id_product bigint                                                  not null,
    name       varchar(250) charset utf8 default 'product_default.png' not null,
    constraint product_image_fk_product
        foreign key (id_product) references product (id)
)
    comment 'save image for product';

create table if not exists product_variant
(
    id          bigint auto_increment
        primary key,
    count       int                       default 0                     not null,
    thumnail    varchar(250) charset utf8 default 'product_default.png' not null,
    slug        varchar(250) charset utf8                               not null,
    description varchar(250) charset utf8 default ''                    not null,
    discount    int                       default 0                     not null,
    start_at    datetime                  default '2022-10-10 00:00:00' not null,
    end_at      datetime                  default '2022-10-10 00:00:00' not null,
    status      tinyint                   default 1                     not null comment '0: disabled
1: enabled',
    created_at  datetime                  default '2022-10-10 00:00:00' not null,
    updated_at  timestamp                 default '2022-10-10 00:00:00' not null,
    id_product  bigint                                                  not null,
    constraint product_variant_fk_product
        foreign key (id_product) references product (id)
);

create table if not exists cart_item
(
    id                 bigint auto_increment
        primary key,
    id_product_variant bigint                                 not null,
    id_customer        bigint                                 not null,
    count              int      default 1                     not null,
    price              bigint                                 not null comment ' = price (product variant) * count',
    status             tinyint  default 1                     not null comment '0: disabled
1: enabled',
    created_at         datetime default '2022-10-10 00:00:00' not null,
    constraint cart_item_fk_customer
        foreign key (id_customer) references customer (id),
    constraint cart_item_fk_product_variant
        foreign key (id_product_variant) references product_variant (id)
);

create table if not exists order_detail
(
    id                 bigint auto_increment
        primary key,
    id_product_variant bigint not null,
    id_order           bigint not null,
    constraint order_detail_fk_order
        foreign key (id_order) references `order` (id),
    constraint order_detail_fk_product_variant
        foreign key (id_product_variant) references product_variant (id)
);

create table if not exists product_variant_image
(
    id                 bigint auto_increment
        primary key,
    id_product_variant bigint                                                  not null,
    name               varchar(250) charset utf8 default 'product_default.png' not null,
    constraint product_variant_image_fk_product_variant
        foreign key (id_product_variant) references product (id)
)
    comment 'save image for product variant';

create table if not exists product_variant_option
(
    id                 bigint auto_increment
        primary key,
    id_option          bigint not null,
    id_product_variant bigint not null,
    constraint product_variant_option_fk_option
        foreign key (id_option) references `option` (id),
    constraint product_variant_option_fk_product_variant
        foreign key (id_product_variant) references product_variant (id)
);

create table if not exists property_group
(
    id         bigint auto_increment
        primary key,
    name       varchar(250) charset utf8               not null,
    created_at datetime  default '2022-10-10 00:00:00' not null,
    updated_at timestamp default '2022-10-10 00:00:00' not null
)
    comment 'product property group ( color,  width, height, custome part)';

create table if not exists property
(
    id                bigint auto_increment
        primary key,
    name              varchar(250) charset utf8 default '' not null,
    value             varchar(250) charset utf8 default '' not null,
    id_property_group bigint                               not null,
    constraint property_fk_property_group
        foreign key (id_property_group) references property_group (id)
            on delete cascade
);

create table if not exists product_variant_property
(
    id                 bigint auto_increment
        primary key,
    id_property        bigint not null,
    id_product_variant bigint not null,
    constraint product_variant_property_fk_product_variant
        foreign key (id_product_variant) references product_variant (id),
    constraint product_variant_property_fk_property
        foreign key (id_property) references property (id)
);

create table if not exists user
(
    id         bigint                                                  not null
        primary key,
    name       varchar(250) charset utf8                               null,
    avatar     varchar(250) charset utf8 default 'default.png'         not null,
    email      varchar(250) charset utf8                               not null,
    password   varchar(250) charset utf8 default ''                    not null,
    status     tinyint                   default 1                     not null comment '0: Disabled
1: Enabled
',
    role       tinyint                   default 0                     not null comment '0: employee
1: admin',
    created_at datetime                  default '2022-10-10 00:00:00' not null,
    update_at  timestamp                 default '2022-10-10 00:00:00' not null,
    constraint user_email_uindex
        unique (email)
)
    comment 'admin account';


