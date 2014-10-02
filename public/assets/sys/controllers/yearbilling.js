function YearBillingCtrl ($scope)
{
    $scope.billing = [
        {
            'year' : '2011',
            'amount' : '35000'
        },
        {
            'year' : '2012',
            'amount' : '25000'
        }
    ];

    $scope.init = function (items)
    {
        $scope.billing = items;
    }
}