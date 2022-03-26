
<style>
/* ---------------------------- */
/*  Table Styles
------------------------------- */

.table-wrapper {
  margin: 50px;
  box-shadow: 0px 35px 50px rgba(27, 31, 49, 0.1);
}

.table {
  border-collapse: collapse;
  width: 100%;
  background-color: white;
}

.table td,
.table th {
  text-align: center;
  padding: 10px;
}

.table td {
  border-right: 1px solid #f8f8f8;
}

/*  thead th color
------------------------------- */

.table thead th {
  color: #ffffff;
  background:  #005000;/* 指定第一個和預設的標題顏色 */
}

.table thead th:nth-child(2) {
  background: #00A000;/*#0000A0;*/ /* 指定第二個標題顏色 */
}

.table thead th:nth-child(3) {
  background: #00D000;/* 指定第三個標題顏色 */
}

.table thead th:nth-child(4) {
  background: #DDDD3B;/* 指定第四個標題顏色 */
}

.table thead th th:nth-child(5){
  color: #ffffff;
  background:  #005000;/* 指定第5個標題顏色 */
}


.table thead th:nth-child(6) {
  background: #00A000; /* 指定第6個標題顏色 */
}

.table thead th:nth-child(7) {
  background: #00D000;/* 指定第7個標題顏色 */
}

.table thead th:nth-child(8) {
  background: #DDDD3B;/* 指定第8個標題顏色 */
}

.table thead th th:nth-child(9){
  color: #ffffff;
  background:  #005000;/* 指定第9個標題顏色 */
}

.table thead th:nth-child(10) {
  background: #00A000; /* 指定第10個標題顏色 */
}

.table thead th:nth-child(11) {
  background: #00D000;/* 指定第11個標題顏色 */
}

.table thead th:nth-child(12) {
  background: #DDDD3B;/* 指定第12個標題顏色 */
}
.table thead th:nth-child(13) {
  background: #005000;/* 指定第13個標題顏色 */
}

.table thead th:nth-child(14) {
  background: #000000;/* 指定第14個標題顏色 */
}



/*
.table thead th {
  color: #ffffff;
  background: #005000;/*#005000; *//* 指定第一個和預設的標題顏色 */
}

.table thead th:nth-child(2) {
  background: #00A000;/*#0000A0;*/ /* 指定第二個標題顏色 */
}

.table thead th:nth-child(3) {
  background: #00D000;/* 指定第三個標題顏色 */
}

.table thead th:nth-child(4) {
  background: #DDDD3B;/*#FFFF6E;*//*#D4D400; *//* 指定第四個標題顏色 */
  /*color: #C0C0C0;*//*#AFAFAF;*/
}*/

/*  table ul
------------------------------- */

.table ul {
  padding: 20px;
  margin: 0;
  text-align: left;
}
.table ul li {
  border-bottom: 1px solid #e7e7e7;
  padding: 5px;
  position: relative;
  list-style-type: none;
}

/*  Responsive
------------------------------- */

@media (max-width: 767px) {
  .table-wrapper {
    margin: 30px 15px;
  }

  .table thead {
    display: none;
  }

  .table td {
    display: block; /* 一定要下！ */
    padding: 0;
  }

  .table td:before {
    content: attr(data-title); /* 顯示 data-title */
    display: inline-block;
    width: 100%;
    font-weight: 500;
    padding: 6px 0;
    color: #ffffff;
    background: #008000; /* 指定第一個和預設的標題顏色 */
  }

  .table td:nth-child(2):before {
    background: #00FF00; /* 指定第二個標題顏色 */
  }

  .table td:nth-child(3):before {
    background: #0000FF; /* 指定第三個標題顏色 */
  }

  .table td:nth-child(4):before {
    background: #FFFF0F; /* 指定第四個標題顏色 */
  }
}
</style>
