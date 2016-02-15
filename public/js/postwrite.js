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