CREATE TABLE insight (
    id SERIAL PRIMARY KEY NOT NULL,
    at boolean,
    hws boolean,
    pre boolean,
    sol_hours_required integer,
    sols_checked varchar(100)
);
