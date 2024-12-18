var currentPage = 1;
var pageCount = 1;
var rowData = [];
var gridApi;
var showingCount = 10;
var showingCountArray = [10, 15, 25, 50, 100, 500, 1000];

var currentPage2 = 1;
var pageCount2 = 1;
var rowData2 = [];
var gridApi2;
var showingCount2 = 10;
var showingCountArray2 = [10, 15, 25, 50, 100, 500, 1000];

var defaultColDefAgGrid = {
    flex: 1, // Sütunların esnekliği
    resizable: true,
    cellEditor: "agSelectCellEditor",
};

function sendData(data) {
    var result = data == null ? "" : data;
    if (typeof data === "string")
        result =
            data != null
                ? JSON.stringify(data).replaceAll('"', "").replaceAll("'", "")
                : "";

    return result;
}

function prevPage() {
    if (currentPage > 1) changePage(currentPage + -1);
}

function nextPage() {
    if (currentPage < pageCount) changePage(currentPage + 1);
}

function newPageCount(new_page_count, page) {
    if (!page) {
        page = currentPage;
    }
    var pagination = document.getElementById("paginate");

    var html = `<div class="float-right">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="javascript:;" onclick="prevPage();" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>`;
    if (new_page_count <= 10) {
        for (let i = 1; i <= new_page_count; i++) {
            html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
        }
    } else {
        html += `<li class="page-item" id="pagination1">
                                    <a class="page-link " href="javascript:;" onclick="changePage(1)">
                                        1
                                    </a>
                                </li>`;
        if (page - 2 > 1) {
            html += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
            for (let i = page - 2; i <= page + 2 && i < new_page_count; i++) {
                html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
            }
        } else {
            for (let i = 2; i <= page + 2 && i < new_page_count; i++) {
                html += `<li class="page-item" id="pagination${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
            }
        }

        if (page + 2 < new_page_count - 1) {
            html += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
        }

        html += `<li class="page-item" id="pagination${new_page_count}">
                                    <a class="page-link " href="javascript:;" onclick="changePage(${new_page_count})">
                                        ${new_page_count}
                                    </a>
                                </li>`;
    }

    html += `<li class="page-item">
                <a class="page-link" href="javascript:;" onclick="nextPage();" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>`;

    html += showingData();

    pagination.innerHTML = html;
}

function showingData() {
    var code_html = `<div class="row" style="align-items: end;">
                        <div>
                            <label for="showContent" class="mt-2 mr-2">Gösterilecek Adet:</label>
                        </div>
                        <div>
                            <select name="" id="showContent" class="form-control" onchange="changeShowingCount()">`;
    for (let i = 0; i < showingCountArray.length; i++)
        code_html += `<option value="${showingCountArray[i]}" ${
            showingCount == showingCountArray[i] ? "selected" : ""
        }>${showingCountArray[i]}</option>`;

    code_html += ` </select>
                    </div>
                </div>`;

    return code_html;
}

function changeShowingCount() {
    showingCount = document.getElementById("showContent").value;
    changePage(1);
}

function getOtherData(page_count, page) {
    gridApi.setGridOption("rowData", rowData);

    newPageCount(page_count, page);
    pageCount = page_count;

    currentPaginationId = "pagination" + currentPage;
    paginationId = "pagination" + page;

    if (document.getElementById(currentPaginationId))
        document.getElementById(currentPaginationId).classList.remove("active");
    if (document.getElementById(paginationId))
        document.getElementById(paginationId).classList.add("active");

    currentPage = page;
}

function gridOptionsData(columnDefs) {
    const gridOptions = {
        rowData: rowData,
        columnDefs: columnDefs,
        defaultColDef: defaultColDefAgGrid,
        animateRows: true,
        localeText: {
            noRowsToShow: "Herhangi bir veri bulunamadı",
        },
        onCellClicked: (event) => {
            if (typeof clickFirstTable === "function") {
                clickFirstTable(event); //Eğer tıklandığında işlem yapılacaksa bu fonksiyon kullanılır
            }
        },
    };

    const myGridElement = document.querySelector("#myGrid");
    gridApi = agGrid.createGrid(myGridElement, gridOptions);
}

//Eğer bir sayfada iki tane tablo varsa, ikinci tablo aşağıdaki kodlar ile çalışacaktır:

function prevPage2() {
    if (currentPage2 > 1) changePage2(currentPage2 + -1);
}

function nextPage2() {
    if (currentPage2 < pageCount2) changePage2(currentPage2 + 1);
}

function newPageCount2(new_page_count2, page2) {
    if (!page2) {
        page2 = currentPage2;
    }
    var pagination2 = document.getElementById("paginate2");

    var html2 = `<div class="float-right">
                    <ul class="pagination2">
                        <li class="page-item">
                            <a class="page-link" href="javascript:;" onclick="prevPage2();" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>`;
    if (new_page_count2 <= 10) {
        for (let i = 1; i <= new_page_count2; i++) {
            html2 += `<li class="page-item" id="pagination2${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage2(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
        }
    } else {
        html2 += `<li class="page-item" id="pagination21">
                                    <a class="page-link " href="javascript:;" onclick="changePage2(1)">
                                        1
                                    </a>
                                </li>`;
        if (page2 - 2 > 1) {
            html2 += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
            for (
                let i = page2 - 2;
                i <= page2 + 2 && i < new_page_count2;
                i++
            ) {
                html2 += `<li class="page-item" id="pagination2${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage2(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
            }
        } else {
            for (let i = 2; i <= page2 + 2 && i < new_page_count2; i++) {
                html2 += `<li class="page-item" id="pagination2${i}">
                                            <a class="page-link " href="javascript:;" onclick="changePage2(${i})">
                                                ${i}
                                            </a>
                                        </li>`;
            }
        }

        if (page2 + 2 < new_page_count2 - 1) {
            html += `<li class="page-item">
                                    <a class="page-link " href="javascript:;">
                                        ...
                                    </a>
                                </li>`;
        }

        html2 += `<li class="page-item" id="pagination2${new_page_count2}">
                                    <a class="page-link " href="javascript:;" onclick="changePage2(${new_page_count2})">
                                        ${new_page_count2}
                                    </a>
                                </li>`;
    }

    html2 += `<li class="page-item">
                <a class="page-link" href="javascript:;" onclick="nextPage2();" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>`;

    html2 += showingData2();

    pagination2.innerHTML = html2;
}

function showingData2() {
    var code_html2 = `<div class="row" style="align-items: end;">
                        <div>
                            <label for="showContent2" class="mt-2 mr-2">Gösterilecek Adet:</label>
                        </div>
                        <div>
                            <select name="" id="showContent2" class="form-control" onchange="changeShowingCount2()">`;
    for (let i = 0; i < showingCountArray2.length; i++)
        code_html2 += `<option value="${showingCountArray2[i]}" ${
            showingCount2 == showingCountArray2[i] ? "selected" : ""
        }>${showingCountArray2[i]}</option>`;

    code_html2 += ` </select>
                    </div>
                </div>`;

    return code_html2;
}

function changeShowingCount2() {
    showingCount2 = document.getElementById("showContent2").value;
    changePage2(1);
}

function getOtherData2(page_count2, page2) {
    gridApi2.setGridOption("rowData", rowData2);

    newPageCount2(page_count2, page2);
    pageCount2 = page_count2;

    currentPaginationId2 = "pagination2" + currentPage2;
    paginationId2 = "pagination2" + page2;

    if (document.getElementById(currentPaginationId2))
        document
            .getElementById(currentPaginationId2)
            .classList.remove("active");
    if (document.getElementById(paginationId2))
        document.getElementById(paginationId2).classList.add("active");

    currentPage2 = page2;
}

function gridOptionsData2(columnDefs2) {
    const gridOptions2 = {
        rowData: rowData2,
        columnDefs: columnDefs2,
        defaultColDef: defaultColDefAgGrid,
        animateRows: true,
        localeText: {
            noRowsToShow: "Herhangi bir veri bulunamadı",
        },
    };

    const myGridElement2 = document.querySelector("#myGrid2");
    gridApi2 = agGrid.createGrid(myGridElement2, gridOptions2);
}
