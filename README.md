# symfony-inference-system

Inference System for Selecting the Optimal Programming Language.

![Screen](./docs/screenshot.png)

## Technology stack

* PHP 8.3
* Symfony Framework 6.4
* TypeScript 5
* Angular Framework 16
* Ionic Components
* REST API
* No database!

## Criteria of choice

### Classical logic select box

There are two multi-select fields `Language Usage` and `Features` with `AND` and `OR` search methods.

These fields are used to narrow down your results.

### Fuzzy logic fields

There are three fields using fuzzy logic: `Minimum performance`, `Minimum popularity`,`Language experience` - they 
take the values `Very high`, `High`, `Average`, `Low`, `Very low`, sometimes `None`.

Based on these values, a numerical score is calculated using a fuzzy logic mechanism.

### Popularity forecasts

There is a selectbox called `Popularity - Year` where you can select a year from the future. 
This is used to change the behavior of the `Minimum Popularity` field. By default, real data from 2023 are taken. 
However, years in the future can be selected and the data is predicted using the linear regression 
algorithm `sklearn.linear_model.BayesianRidge`. A Python command was used to generate the data - `ml` directory.

## Copyrights

Copyright © Rafał Mikołajun 2024.
