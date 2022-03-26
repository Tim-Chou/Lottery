
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
  background: #ffb4a2; /* 指定第一個和預設的標題顏色 */
}

.table thead th:nth-child(2) {
  background: #e5989b; /* 指定第二個標題顏色 */
}

.table thead th:nth-child(3) {
  background: #b5838d; /* 指定第三個標題顏色 */
}

.table thead th:nth-child(4) {
  background: #6d6875; /* 指定第四個標題顏色 */
}

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
    background: #ffb4a2; /* 指定第一個和預設的標題顏色 */
  }

  .table td:nth-child(2):before {
    background: #e5989b; /* 指定第二個標題顏色 */
  }

  .table td:nth-child(3):before {
    background: #b5838d; /* 指定第三個標題顏色 */
  }

  .table td:nth-child(4):before {
    background: #6d6875; /* 指定第四個標題顏色 */
  }
}
</style>
