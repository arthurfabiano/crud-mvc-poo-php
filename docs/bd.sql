create table clients
(
    id    bigint auto_increment
        primary key,
    name  varchar(255) collate utf8mb4_general_ci null,
    email varchar(255) collate utf8mb4_general_ci null,
    phone varchar(100)                            null
);

create table companies
(
    id   bigint auto_increment
        primary key,
    name varchar(255) collate utf8mb4_general_ci not null
);

create table bills_to_pay
(
    id         bigint auto_increment
        primary key,
    valor      decimal(10, 2)    null,
    data_pagar date              not null,
    pago       tinyint default 0 null,
    id_empresa bigint            null,
    constraint bills_to_pay_companies_id_fk
        foreign key (id_empresa) references companies (id)
);
