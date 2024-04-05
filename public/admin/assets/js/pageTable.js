var currentPage = 1;
var pageCount = 1;
var rowData = [];
var gridApi;
var showingCount = 10;
var showingCountArray = [10, 15, 25, 50, 100, 500, 1000];

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
    };

    const myGridElement = document.querySelector("#myGrid");
    gridApi = agGrid.createGrid(myGridElement, gridOptions);
}
