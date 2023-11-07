cmake_minimum_required(VERSION 3.25)
project(LR_1)

set(CMAKE_CXX_STANDARD 14)

include_directories(include)
include_directories(src)

add_executable(LR_1
        include/Cash.h
        include/Cashiers.h
        include/CashiersGateway.h
        include/Clients.h
        include/ClientsGateway.h
        include/Connection.h
        include/Currencies.h
        include/CurrenciesGateway.h
        include/Gateway.h
        include/List.h
        include/Menu.h
        include/Object.h
        include/Rates.h
        include/RatesGateway.h
        include/Table.h
        include/Transactions.h
        include/TransactionsGateway.h
        include/UserAction.h
        src/Cashiers.cpp
        src/CashiersGateway.cpp
        src/Clients.cpp
        src/ClientsGateway.cpp
        src/Connection.cpp
        src/Currencies.cpp
        src/CurrenciesGateway.cpp
        src/List.cpp
        src/Menu.cpp
        src/Rates.cpp
        src/RatesGateway.cpp
        src/Table.cpp
        src/Transactions.cpp
        src/TransactionsGateway.cpp
        src/UserAction.cpp
        main.cpp)

target_link_libraries (LR_1 odbc32)
