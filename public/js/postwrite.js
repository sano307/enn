          $(document).ready(function() {
              $('postWrite_form').submit(function() {
                  if ( $('#postContent').val() == '' ) {
                      alert("����Ʈ ������ �Է����ּ���!");
                      return false;
                  } else {
                      return true;
                  }
              });
          });