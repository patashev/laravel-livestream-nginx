/* Set the defaults for DataTables initialisation */

function getOrderBy(element)
{
    var orderByVal = $(element).attr('data-order-by');

    var orderBy = ['created_at', 'desc'];
    if (!(orderByVal == 'false' || orderByVal == false || orderByVal == undefined)) {
        var pieces = orderByVal.split('|');
        if (pieces.length == 1) {
            orderBy = [pieces[0], 'asc'];
        }
        else if (pieces.length == 2) {
            orderBy = [pieces[0], pieces[1]];
        }
    }

    return orderBy;
}
