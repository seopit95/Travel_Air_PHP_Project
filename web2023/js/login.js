function check_input(){
  if(!document.login_form.id.value){
    swal('로그인 실패',"아이디를 입력해주세요!","warning");
    document.login_form.id.focus();
    return;
  }
  if(!document.login_form.pass.value){
    swal('로그인 실패',"비밀번호를 입력해주세요!","warning");
    document.login_form.id.focus();
    return;
  }
  document.login_form.submit();
}

function modify_input(){
  if(!document.log_modify_form.pass.value){
    swal('수정 실패',"비밀번호를 입력해주세요!","warning");
    document.login_form.pass.focus();
    return;
  }
  if(!document.log_modify_form.pass2.value){
    swal('수정 실패',"비밀번호를 입력해주세요!","warning");
    document.login_form.pass2.focus();
    return;
  }
  if(!document.log_modify_form.phone1.value){
    swal('수정 실패',"연락처를 입력해주세요!","warning");
    document.login_form.phone1.focus();
    return;
  }
  if(!document.log_modify_form.phone2.value){
    swal('수정 실패',"연락처를 입력해주세요!","warning");
    document.login_form.phone2.focus();
    return;
  }
  if(!document.log_modify_form.phone3.value){
    swal('수정 실패',"연락처를 입력해주세요!","warning");
    document.login_form.iphone3d.focus();
    return;
  }
  if(!document.log_modify_form.email1.value){
    swal('수정 실패',"이메일을 입력해주세요!","warning");
    document.login_form.email1.focus();
    return;
  }
  if(!document.log_modify_form.email2.value){
    swal('수정 실패',"이메일을 입력해주세요!","warning");
    document.login_form.email2.focus();
    return;
  }
  document.log_modify_form.submit();
}