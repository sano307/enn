<div ng-controller="campJoinController" style="color: black;">
    <fieldset>
        <legend>Camp Join Management</legend>
        <style>
            table {
                min-width: 100%;
            }

            table, th , td {
                border: 1px solid grey;
                border-collapse: collapse;
                padding: 5px;
            }

            table tr:nth-child(odd) {
                background-color: #f2f2f2;
            }

            table tr:nth-child(even) {
                background-color: #ffffff;
            }
        </style>
        <table>
            <tr>
                <td></td>
                <td>Nickname</td>
                <td>Country</td>
                <td>Region</td>
                <td>Sex</td>
                <td></td>
                <td></td>
            </tr>
            <tr ng-repeat = "request in requestInfo ">
                <td><img ng-src="/public/img/common/common_profileImg.png" style="width: 100px; height: 100px;"/></td>
                <td>{{request.m_nickname}}</td>
                <td>{{request.m_nationally}}</td>
                <td>{{request.m_region}}</td>
                <td>{{request.m_sex}}</td>
                <td><a class="button tiny danger radius" style="font-weight: bold; font-size: 18px;" ng-click="goRefused(request.m_idx)">refused</a></td>
                <td><a class="button tiny info radius" style="font-weight: bold; font-size: 18px;" ng-click="goApprove(request.m_idx)">approve</a></td>
            </tr>
        </table>
    </fieldset>
</div>