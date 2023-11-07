#include <string>
#include "Menu.h"
#include "Connection.h"
#include <ctime>

using namespace std;

int main()
{
    srand(time(NULL));
    Connection::DB()->checkTables();
    Menu menu;
    menu.start();
    return 0;
}
