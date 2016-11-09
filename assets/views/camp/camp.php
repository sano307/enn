<div class="camp_index" ng-controller="campController" style="color: black;">
    <fieldset>
        <legend>Camp Profile</legend>
        <div class="small-3 columns">
            <img ng-src="/public/img/camp/{{campInfo.c_idx}}/{{campInfo.c_campImgName}}.{{campInfo.c_campImgExt}}" style="width: 200px; height: 200px;"/>
        </div>
        <div class="small-9 columns">
            <span style="font-size: 22px; font-weight: bold;">{{campInfo.c_campName}}</span><br/><br/>
            <span style="font-size: 18px;">{{campInfo.c_campIntroduction}}</span><br/><br/>
            <span>{{campInfo.c_campCountry}}, {{campInfo.c_campRegion}}</span><br/><br/>
            <a class="button tiny info" style="font-size: 18px; font-weight: bold;" ng-show="campInfo.m_idx==login_idx" ng-click="goJoinManager(campInfo.c_idx)">Join Management</a>
        </div>
    </fieldset>
    <fieldset>
        <legend>Camp Write</legend>
            제목 : <input type="text" ng-model="writeInfo.title" required />
            내용 : <textarea ng-model="writeInfo.content" required></textarea>
            <div ngf-drop ngf-select ng-model="files" class="drop-box"
                 ngf-drag-over-class="'dragover'" ngf-multiple="true" ngf-allow-dir="true"
                 accept="image/*" ngf-resize="width: 100, height: 100, quality: 1.0, type: 'image/jpeg', pattern='.jpg'"
                 ngf-pattern="'image/*'">Camp post image drop or click to upload</div>
            <div ng-repeat="image in files" style="display: inline;">
                <img ngf-src="image" ngf-resize="{width: 320, height: 320, quality: 0.9}">
            </div>
            <button type="submit" ng-click="submit()">submit</button>
    </fieldset>
    <fieldset>
        <legend>Camp post</legend>
<!--        <div ng-repeat="post in postInfo" ng-show="postInfo" style="width: 450px; height: 300px;">
            <img src="/public/img/camp/{{post.c_idx}}/{{post.p_postThumbName}}.{{post.p_postThumbExt}}">
        </div>-->
<!--        <div class="row align-stretch" ng-repeat="post in postInfo" ng-show="postInfo" style="width: 700px; border: 1px solid red;">
            <div class="columns" style="display: inline;">
                <img src="/public/img/camp/{{post.c_idx}}/{{post.p_postThumbName}}.{{post.p_postThumbExt}}">
            </div>
            <div class="columns" style="display: inline;">
                제목 : {{post.p_title}}<br/>
                내용 : {{post.p_content}}
            </div>
        </div>-->
        <div class="small-3 columns" ng-repeat="post in postInfo">
            <div class="image-wrapper overlay-fade-in">

                <a ng-click="open(post.p_idx)">
                   <!-- <img src="https://tourneau.scene7.com/is/image/tourneau/DEV9900004?hei=450&wid=300&fmt=png-alpha&resMode=bicub&op_sharpen=1" />-->
                    <img ng-src="/public/img/camp/{{post.c_idx}}/{{post.p_postThumbName}}.{{post.p_postThumbExt}}" style="height: 300px; width: 300px;">

                    <div class="image-overlay-content">
                        <h2>hits : {{post.p_postHits}}</h2>
                        <h2>goods : {{post.p_postGoods}}</h2>
                    </div>
                </a>
            </div>
            <div>
                {{post.p_registedTime}}<br/>
                {{post.p_title}}<br/>
            </div>
            <script type="text/ng-template" id="myModalContent.html">
                <span><h3>{{items.certainPostInfo[0].p_title}} / {{items.certainPostInfo[0].p_registedTime}}</h3></span>
                <button type="button" class="button tiny info" ng-model="singleModel" ng-click="toGood(items.certainPostInfo[0].p_idx)" style="font-size: 24px; font-weight: bold;">
                    Good
                </button>
                <div class="row" style="height: 750px;">
                    <div class="large-6 columns" style="position: relative; overflow: auto; min-height: 100%; padding: 0; margin-bottom: 0;">
                        <div class="row" style="position: absolute; padding: 30px; text-align: left; height: 100%; width: 100%;">
                            <div class="small-12 columns" ng-repeat="item in items.certainPostImageInfo">
                                <img ng-src="/public/img/camp/{{items.certainPostInfo[0].c_idx}}/{{item.pa_postImgName}}.{{item.pa_postImgExt}}" style="height: 400px; width: 400px;"/>
                            </div>
                        </div>
                    </div>
                    <div class="large-6 columns" style="position: relative; overflow: auto; min-height: 100%; padding: 0; margin-bottom: 0;">
                        <div class="small-12 columns" style="position: absolute; padding: 30px; text-align: left; width: 100%;">
                            <div class="small-5 columns">
                                <img ng-src="/assets/img/1.jpg" style="width: 75px; height: 75px; border-radius: 50%;"><br/>
                                {{items.certainPostInfo[0].m_nickname}}<br/>
                                {{items.certainPostInfo[0].m_nationally}}, {{items.certainPostInfo[0].m_region}}<br/>
                                {{item.certainPostInfo[0].registedTime}}
                            </div>
                            <div class="small-7 columns">
                                <span style="font-weight: bold; font-size: 18px;">{{items.certainPostInfo[0].p_content}}</span>
                            </div>
                            <div class="small-12 columns">
                                <input type="text" ng-model="replyInfo.content" ng-keypress="keyPress($event, items.certainPostInfo[0].p_idx)" required/>
                            </div>
                            <div class="small-12 columns" ng-repeat="reply in items.certainPostReplyInfo" style="overflow-x: hidden;">
                                <div class="small-5 columns">
                                    <img ng-src="/public/img/common/common_profileImg.png" style="width: 75px; height: 75px; border-radius: 50%;">
                                    {{reply.m_nickname}}<br/>
                                    {{reply.m_nationally}}, {{reply.m_region}}<br/>
                                    {{reply.pr_registedTime}}
                                </div>
                                <div class="small-7 columns">
                                    <p>{{reply.pr_content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="close-reveal-modal" ng-click="cancel()">&#215;</a>
            </script>
        </div>
        <div>
            <a ng-click="postLoad()">page load</a>
        </div>
    </fieldset>
</div>