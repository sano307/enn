          <!-- 컨텐츠로 흘러가는 메뉴 -->
          <li><a href="#about">오늘의 친구</a></li>
          <li><a href="#contact">새로운 교류회</a></li>
          <form id="postWrite_form" action="/post/post_write/<?=$_SESSION['login_idx']?>/1" method="post" enctype="multipart/form-data">
              <textarea id="postContent" name="postContent" rows="10" cols="50" placeholder="글을 작성해주세요."></textarea><br>
              <input type="file" name="postImages[]"  accept="image/*" multiple/><br>
              <button><li class="fi-pencil"></li></button>
          </form>
          <script>
          $(document).ready(function() {
              $('postWrite_form').submit(function() {
                  if ( $('#postContent').val() == '' ) {
                      alert("포스트 내용을 입력해주세요!");
                      return false;
                  } else {
                      return true;
                  }
              });
          });
          </script>
          <div class="large-8 column">
              <h1><b>인기 포스트</b></h1>
          </div>
          <div class="row text-center">
            <div class="row">
          <?php
              // 포스트를 출력 hexagon
              foreach ( $getPostInfo as $row ) {
                echo "<ul class='first fourHexa'>";
                      echo"
                      <li>
                        <div class='hexagon'>
                          <div class='hexagon-in1'>
                            <div class='hexagon-in2'>";
                                    if ( $row['p_postThumbExt'] == "0" ) {
                                        echo "<a href='/detail_timeline/index/{$row['p_idx']}/{$row['c_idx']}'style='color: black;'><h3>{$row['p_postThumbName']}</h3></a>";
                                    } else {
                                        $argImage = $row['p_postThumbName'] . "." . $row['p_postThumbExt'];
                                        if ( $row['c_idx'] != 1 ) {
                                            echo "<a href='<?php echo URL;?>/detail_timeline/index/{$row['p_idx']}/{$row['c_idx']}' data-lightbox='gallery' title='Title'><img src='/public/img/camp/$getNowMemberNum/$argImage' alt=''></a>";
                                        } else {
                                            echo "<a href='/public/img/member/$getNowMemberNum/$argImage' data-lightbox='gallery' title='<a href=''><img src='/public/img/member/$getNowMemberNum/$argImage' alt=''></a>";
                                        }
                                    }
                                    echo "<i class='fi-heart'></i> {$row['p_postGoods']}<br>";
                                    echo "<i class='fi-eye'></i> {$row['p_postHits']}";
                        echo "
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    ";
                  }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div id="about" class="container info section">
      <div class="row">
          <div class="large-4 column">
              <div class="hexagon">
                  <div class="hexagon-in1">
                      <div class="hexagon-in2">여긴어디?</div>
                  </div>
              </div>
          </div>
          <div class="large-8 column">
              <h1><b>오늘의 친구</b></h1>
              <h1>정상교 님</h1>
              <p>나 이쁘죵?</p>
          </div>
      </div>
  </div>

  <div id="contact" class="container contact section">
      <div class="row">
        <div class="large-8 column">
            <h1><b>새로운 교류회</b></h1>
            <h1>땡떙교류회</h1>
        </div>
        <div class="large-4 column">
            <div class="hexagon">
                <div class="hexagon-in1">
                    <div class="hexagon-in2">여긴어디?</div>
                </div>
            </div>
        </div>
      </div>
  </div>
