camp.controller('indexController', ['$scope', '$location', '$http', '$window', 'socket', function( $scope, $location, $http, $window, socket ) {
    $scope.effect = 'slideleft';
    $scope.pageClass = 'camp';
    $scope.campInfo = [];
    $scope.page = 1;

    $scope.$watch('$viewContentLoaded', function() {
        socket.emit('enter:main', {user: login_nickname});
    });

    // 캠프에 가입하기 버튼 클릭
    $scope.join = function( c_idx ) {
        console.log("c");
        $http({
            method: 'post',
            url: '/camp/setCampNewMember',
            data: {'c_idx': c_idx, 'm_idx': login_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            console.log(data);
            switch ( data.msg ) {
                case 'success': $window.alert('camp join request success'); break;
                case 'join in process': $window.alert('The camp of the subscription process'); break;
            }
        });
    };

    // 특정 캠프 클릭
    $scope.goCamp = function( c_idx ) {
        $http({
            method: 'post',
            url: '/camp/IsCampMember',
            data: {'c_idx': c_idx, 'm_idx': login_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            console.log(data.msg);
            switch (data.msg) {
                case 'exist': $location.path('/camp/' + c_idx); break;
                case 'join in process': $window.alert('The camp of the subscription process'); break;
                case 'not exist': $window.alert('Not joined in this camp'); break;
            }
        })
    };

    // 나라 정보
    $scope.countriesInfo = {
        countries: [
            {key: 'korea', name: 'Korea'},
            {key: 'japan', name: 'Japan'}
        ],
        selectedCountry: {key: '', name: 'Country'}
    };

    // 지역 정보
    $scope.regionInfo = {
        regions: [
            {key: '', name: 'Region'}
        ], selectedRegion: {key: '', name: 'Region'}
    };

    // 특정 나라를 선택했을 때
    $scope.changeCountry = function( selectedCountry ) {
        $scope.campInfo = [];
        $scope.page = 1;
        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name:selectedCountry.name};

        // 선택된 국가에 해당하는 캠프들의 정보를 리턴
        $http({
            method: 'post',
            url: '/camp/getCampByCountry',
            data: {'country': selectedCountry.key, 'm_idx': login_idx, 'pageNum': $scope.page},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            console.log(data);
            for ( var iCount = 0; iCount < data.length; iCount++ ) {
                $scope.campInfo.push(data[iCount]);
            }
            $scope.page += 1;
        });

        // 선택된 국가에 해당하는 지역을 리턴
        $http({
            method: 'post',
            url: '/start/getRegion',
            data: {'country': selectedCountry.key},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            if( data ) {
                /* 성공적으로 결과 데이터가 넘어 왔을 때 처리 */
                $scope.regionInfo.regions = [];
                $scope.regionInfo.selectedRegion = {};

                for ( var iCount in data ) {
                    var str = data[iCount]['nri_region'];
                    var result = str.substring(0, 1).toUpperCase() + str.substring(1, str.length).toLowerCase();
                    $scope.regionInfo.regions[iCount] = {key: data[iCount]['nri_region'], name: result};

                    if ( iCount === 0 ) {
                        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name: selectedCountry.name};
                        $scope.regionInfo.selectedRegion = {key: data[iCount]['nri_region'], name: result};
                    }
                }
            }
            else {
                /* 통신한 URL에서 데이터가 넘어오지 않았을 때 처리 */
                console.log(data);
            }
        }).error(function(data, status, headers, config) {
            /* 서버와의 연결이 정상적이지 않을 때 처리 */
            console.log(status);
        });
    };

    // 특정 지역을 선택했을 때
    $scope.changeRegion = function( selectedRegion ) {
        $scope.campInfo = [];
        $scope.page = 1;
        $scope.regionInfo.selectedRegion = {key: selectedRegion.key, name: selectedRegion.name};

        // 선택된 지역에 해당하는 캠프들의 정보를 리턴
        $http({
            method: 'post',
            url: '/camp/getCampByRegion',
            data: {'region': selectedRegion.key, 'm_idx': login_idx, 'pageNum': $scope.page},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            for ( var iCount = 0; iCount < data.length; iCount++ ) {
                $scope.campInfo.push(data[iCount]);
            }
            $scope.page += 1;
        });
    };

    $scope.loadCamp = function() {
        if ( $scope.regionInfo.selectedRegion ) {
            $http({
                method: 'post',
                url: '/camp/getCampByRegion',
                data: {'region': selectedRegion.key, 'm_idx': login_idx, 'pageNum': $scope.page},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).success(function(data, status, headers, config) {
                for ( var iCount = 0; iCount < data.length; iCount++ ) {
                    $scope.campInfo.push(data[iCount]);
                }
                $scope.page += 1;
            });
        } else {
            $http({
                method: 'post',
                url: '/camp/getCampByCountry',
                data: {'country': selectedCountry.key, 'm_idx': login_idx, 'pageNum': $scope.page},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).success(function(data, status, headers, config) {
                for ( var iCount = 0; iCount < data.length; iCount++ ) {
                    $scope.campInfo.push(data[iCount]);
                }
                $scope.page += 1;
            });
        }
    };
}]);

camp.controller('createController', ['$scope', '$location', '$http', '$window', 'Upload', function( $scope, $location, $http, $window, Upload ) {
    $scope.effect = 'slideleft';
    $scope.pageClass = 'campCreate';

    $scope.camp = function() {
        $location.path('/camp');
    };

    $scope.countriesInfo = {
        countries: [
            {key: 'korea', name: 'Korea'},
            {key: 'japan', name: 'Japan'}
        ],
        selectedCountry: {key: '', name: 'Country'}
    };

    $scope.regionInfo = {
        regions: [
            {key: '', name: 'Region'}
        ], selectedRegion: {key: '', name: 'Region'}
    };

    $scope.changeCountry = function( selectedCountry ) {
        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name:selectedCountry.name};

        // 선택된 국가에 속하는 지역들을 뽑아온다.
        $http({
            method: 'post',
            url: '/start/getRegion',
            data: {'country': selectedCountry.key},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function(data, status, headers, config) {
            if( data ) {
                /* 성공적으로 결과 데이터가 넘어 왔을 때 처리 */
                console.log(data);

                $scope.regionInfo.regions = [];
                $scope.regionInfo.selectedRegion = {};

                for ( var iCount in data ) {
                    var str = data[iCount]['nri_region'];
                    var result = str.substring(0, 1).toUpperCase() + str.substring(1, str.length).toLowerCase();
                    $scope.regionInfo.regions[iCount] = {key: data[iCount]['nri_region'], name: result};

                    if ( iCount === 0 ) {
                        $scope.countriesInfo.selectedCountry = {key: selectedCountry.key, name: selectedCountry.name};
                        $scope.regionInfo.selectedRegion = {key: data[iCount]['nri_region'], name: result};
                    }
                }
            }
            else {
                /* 통신한 URL에서 데이터가 넘어오지 않았을 때 처리 */
                console.log(data);
            }
        }).error(function(data, status, headers, config) {
            /* 서버와의 연결이 정상적이지 않을 때 처리 */
            console.log(status);
        });
    };

    $scope.changeRegion = function( selectedRegion ) {
        $scope.regionInfo.selectedRegion = {key: selectedRegion.key, name: selectedRegion.name};
    };

    $scope.submit = function() {
        $scope.campData.m_idx = login_idx;
        $scope.toCreate($scope.file);
    };

    $scope.toCreate = function( file ) {
        if ( file ) {
            $scope.campData.country = $scope.countriesInfo.selectedCountry.key;
            $scope.campData.region = $scope.regionInfo.selectedRegion.key;

            if ( file.$error ) {
                return false;
            }

            Upload.upload({
                method: 'post',
                url: '/camp/toCreate',
                data: {'campData': $scope.campData, campImage: file},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).then(function( res ) {
                switch ( res.data.msg ) {
                    case 'success': $window.alert("Camp Create Success"); $location.path('/camp'); break;
                    case 'already': $window.alert("The Campname that is already registered"); break;
                }
            });
        }
    };
}]);

camp.controller('menuController', ['$scope', '$location', '$http', function( $scope, $location, $http ) {
    $scope.camp = function() {
        $location.path('/camp');
    };

    $scope.myCamp = function() {
        $location.path('/camp/myCamp');
    };

    $scope.create = function() {
        $location.path('/camp/create');
    };

    // 검색어를 입력하고, 엔터를 눌렀을 때
    $scope.keyPress = function( keyEvent ) {
        if (keyEvent.which === 13) {
            $http({
                method: 'post',
                url: '/camp/getSearchCamp',
                data: {campName: $scope.searchText},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).success(function (data, status, headers, config) {

            });
        }
    };
}]);

camp.controller('myCampController', ['$scope', '$location', '$http', function( $scope, $location, $http ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'mycamp';

    $scope.$on('$viewContentLoaded', function() {
        $http({
            method: 'post',
            url: '/camp/getMyCampInfo',
            data: {'m_idx': login_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            $scope.myCampInfo = data;
            console.log(data);
        });
    });

    $scope.goCamp = function( c_idx ) {
        $location.path('/camp/' + c_idx);
    }
}]);

camp.controller('recommendController', ['$scope', '$http', function( $scope, $http ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'recommend';

    $scope.$on('$viewContentLoaded', function() {
        $http({
            method: 'post',
            url: '/camp/getWholeCampInfo',
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            $scope.regionInfo = data;
            console.log(data);
        });
    });
}]);

camp.controller('ModalInstanceCtrl', ['$scope', '$modalInstance', 'items', '$http', '$window', function ($scope, $modalInstance, items, $http, $window) {
    $scope.replyInfo = {};
    $scope.replyInfo.page = 1;
    $scope.singleModel = 0;

    $scope.items = items;
    $scope.selected = {
        item: $scope.items[0]
    };

    $scope.reposition = function () {
        $modalInstance.reposition();
    };

    $scope.ok = function () {
        $modalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.toGood = function( p_idx ) {
          $http({
              method: 'post',
              url: '/camp/setCertainPostGood',
              data: {p_idx: p_idx, m_idx: login_idx, modal: $scope.singleModel},
              headers: {'Content-Type': 'application/json; charset=utf-8'}
          }).success(function (data, status, headers, config) {
              if ( data.msg == 1 ) {
                  $window.alert('Good Success!');
              } else {
                  $window.alert('Good Remove!');
              }
              $scope.singleModel = data.msg;
          });
    };

    // 댓글을 입력하고, 엔터를 눌렀을 때
    $scope.keyPress = function( keyEvent, p_idx ) {
        if (keyEvent.which === 13) {
            console.log("cCCC");
            $scope.replyInfo.page = 1;
            $scope.replyInfo.m_idx = login_idx;
            $scope.replyInfo.p_idx = p_idx;

            $http({
                method: 'post',
                url: '/camp/setCertainPostReply',
                data: {replyInfo: $scope.replyInfo},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).success(function (data, status, headers, config) {
                $scope.items.certainPostReplyInfo = data;
                $scope.replyInfo.content = '';
            });
        }
    };
}]);

camp.controller('campController', ['$scope', '$location', '$stateParams', '$http', 'Upload', '$rootScope', '$modal', '$log', function( $scope, $location, $stateParams, $http, Upload, $rootScope, $modal, $log ) {
    $scope.effect = 'slideleft';
    $scope.pageClass = 'certaionCamp';
    $scope.imageInfo = [];
    $scope.writeInfo = {};
    $scope.writeInfo.page = 1;
    $scope.login_idx = login_idx;

    $scope.open = function ( p_idx ) {
        var modalInstance;
        $http({
            method: 'post',
            url: '/camp/getCertainPostInfo',
            data: {p_idx: p_idx, page: 1},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            console.log(data);
            modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                resolve: {
                    items: function () {
                        return data;
                    }
                }
            });

/*            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });*/
        });
    };

    $rootScope.$watch('$stateChangeStart', function(event, toState, fromState) {
        console.log("Cyka");
    });

    $scope.$on('$viewContentLoaded', function() {
        $scope.writeInfo.page = 1;

        $http({
            method: 'post',
            url: '/camp/getCampInfo',
            data: {'c_idx': $stateParams.c_idx, 'page': $scope.writeInfo.page},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            $scope.campInfo = data[0];

            if ( data.length > 1 ) {
                var temp = [];
                for ( var iCount = 1; iCount < data.length; iCount++ ) {
                    temp[iCount - 1] = data[iCount];
                    console.log(data[iCount]);
                }

                $scope.postInfo = temp;
            }

            console.log($scope.writeInfo.page);
        });
    });

    $scope.postLoad = function() {
        $scope.writeInfo.page += 1;

        $http({
            method: 'post',
            url: '/camp/getCampPostInfo',
            data: {'c_idx': $stateParams.c_idx, 'page': $scope.writeInfo.page},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            if ( data.length != 0 ) {
                for ( var iCount = 0; iCount < data.length; iCount++ ) {
                    $scope.postInfo.push(data[iCount]);
                }

                $scope.writeInfo.page += 1;
            }

            console.log($scope.writeInfo.page);
        })
    };

    $scope.goJoinManager = function( c_idx ) {
        $location.path('/camp/' + c_idx + '/joinManager');
    };

/*    $scope.$watch('files', function () {
        $scope.upload($scope.files);
    });*/

    $scope.submit = function() {
        $scope.writeInfo.m_idx = login_idx;
        $scope.writeInfo.c_idx = $stateParams.c_idx;
        $scope.writeInfo.page = 1;
        $scope.toWrite($scope.files);
    };

    $scope.toWrite = function ( files ) {
        $scope.imageInfo = [];
        if ( files && files.length ) {
            for ( var iCount = 0; iCount < files.length; iCount++ ) {
                if ( files[iCount].$error ) {
                    return false;
                }

                $scope.imageInfo[iCount] = files[iCount];
            }

            Upload.upload({
                method: 'post',
                url: '/camp/toWrite',
                data: {'writeInfo': $scope.writeInfo, postImages: files},
                headers: {'Content-Type': 'application/json; charset=utf-8'}
            }).then(function( res ) {
                $scope.postInfo = res.data;
                $scope.writeInfo = '';
                $scope.files = '';
            });
        }
    };
}]);

camp.controller('chatController', ['$scope', '$stateParams', 'socket', function( $scope, $stateParams, socket ) {
    $scope.effect = 'slidedown';
    $scope.pageClass = 'chat';
    $scope.c_idx = $stateParams.c_idx;
    $scope.messages = [];

    // 채팅창 초기화
    $scope.chatReset = function() {
        $scope.messages = [];
    };

    // 메세지를 입력하고, Enter를 누르면 메세지를 보냄
    $scope.keyPress = function(keyEvent) {
        if (keyEvent.which === 13) {
            $scope.sendMessage();
        }
    };

    $scope.sendMessage = function () {
        var sendMessage = {
            roomname: $scope.c_idx,
            user: login_nickname,
            message: $scope.message
        };

        socket.emit('send:message', sendMessage);

        // add the message to our model locally

        // clear message box
        $scope.message = '';
    };

    // 캠프 입장
    $scope.$on('$viewContentLoaded', function() {
        socket.emit('enter:camp', {roomname: $scope.c_idx, user: login_nickname});
        console.log('11111111111111');
    });

    // 캠프에 입장한 회원 알림을 받기
    socket.on('enter:camp', function( data ) {
        var temp = data.from + '님이 입장하셨습니다';
        $scope.messages.push(temp);
    });

    // 다른 회원이 전송한 메세지를 받기
    socket.on('receive:message', function( data ) {
        var temp = '[' + data.from + '] : ' + data.message;
        $scope.messages.push(temp);
    });
}]);

camp.controller('campJoinController', ['$scope', '$location', '$http', '$stateParams', function( $scope, $location, $http, $stateParams ) {
    $scope.effect = 'slideleft';
    $scope.pageClass = 'campJoin';

    $scope.$on('$viewContentLoaded', function() {
        $http({
            method: 'post',
            url: '/camp/getJoinRequestInfo',
            data: {'c_idx': $stateParams.c_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            console.log(data);
            $scope.requestInfo = data;
        });
    });

    $scope.goRefused = function( $m_idx ) {
        $http({
            method: 'post',
            url: '/camp/setJoinRefused',
            data: {'c_idx': $stateParams.c_idx, 'm_idx': $m_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
             $scope.requestInfo = data;
        });
    };

    $scope.goApprove = function( $m_idx ) {
        $http({
            method: 'post',
            url: '/camp/setJoinApprove',
            data: {'c_idx': $stateParams.c_idx, 'm_idx': $m_idx},
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        }).success(function (data, status, headers, config) {
            $scope.requestInfo = data;
        });
    };
}]);