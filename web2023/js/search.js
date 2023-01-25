function check_input(){
  if(!document.search_air.date.value){
    swal('항공편 검색 실패',"날짜를 입력해주세요!","warning");
    document.search_air.eng_name.focus();
    return;
  }
  if(document.search_air.destination.value == "여행지 선택"){
    swal('항공편 검색 실패',"여행지를 선택해주세요!","warning");
    document.search_air.destination.focus();
    return;
  }
  if(document.search_air.person_number.value == 0){
    swal('항공편 검색 실패',"승객 수를 선택해주세요!","warning");
    document.search_air.person_number.focus();
    return;
  }
  if(document.search_air.seat.value == "좌석 선택"){
    swal('항공편 검색 실패',"좌석을 선택해주세요!","warning");
    document.search_air.seat.focus();
    return;
  }

  document.search_air.submit();
}