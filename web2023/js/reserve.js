function check_input(){
  if(!document.reserve_form.eng_name.value){
    alert("영문이름을 입력해주세요");
    document.reserve_form.eng_name.focus();
    return;
  }
  if(!document.reserve_form.registration_number.value){
    alert("주민번호를 입력해주세요!");
    document.reserve_form.registration_number.focus();
    return;
  }
  if(!document.reserve_form.address.value){
    alert("거주지를 입력해주세요!");
    document.reserve_form.address.focus();
    return;
  }
  if(!document.reserve_form.arrive.value == "여행지 선택"){
    alert("여행지를 선택해주세요!");
    document.reserve_form.arrive.focus();
    return;
  }
  if(!document.reserve_form.start_date.value){
    alert("출국일자를 선택해주세요!");
    document.reserve_form.start_date.focus();
    return;
  }
  if(!document.reserve_form.come_date.value){
    alert("귀국일자를 선택해주세요!");
    document.reserve_form.come_date.focus();
    return;
  }

  document.reserve_form.submit();
}