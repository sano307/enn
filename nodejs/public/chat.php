<div ng-controller="chatController" style="color: black; height: 100%; background-color: white;">
    <fieldset id="Camp Chat Room" style="height: 100%;">
        <legend>Camp Chatting Room</legend>
        <div style="height: 90%; overflow: auto;">
            <ul style="list-style: none;">
                <li ng-repeat="msg in messages track by $index">{{msg}}</li>
            </ul>
        </div>
        <div style="width: 100%;">
            <div style="display: inline;">
                <input type="text" ng-model="message" ng-keypress="keyPress($event)" required/>
            </div>
            <div style="display: inline;">
                <a ng-click="chatReset()">reset</a>
            </div>
        </div>
    </fieldset>
</div>