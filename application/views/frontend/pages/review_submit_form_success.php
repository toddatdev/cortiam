<style>
    .rate {
        float: left !important;
        padding: 0 10px;
        width: 100%;
        display: flex;
        flex-direction: row-reverse;
    }

    @media (max-width: 768px) {
        .rate {
            justify-content: left !important;
        }

    }

    label {

        float: left;
    }

    .rate:not(:checked) > input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked) > label {
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #cccccc9c;
    }

    .rate:not(:checked) > label:before {
        content: '★ ';
    }

    .rate > input:checked ~ label {
        color: #00c48d ;
    }

    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #00c48d ;
    }

    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #00c48d ;
    }


    .checked {
        color: #00c48d  !important;
    }

</style>
<style>
    span.fa.fa-star.checked {
        background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxOCAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTkuNjAzNDYgMC45MTQ0NTNDOS4yMTg5MiAwLjEzNTI4NiA4LjEwNzI3IDAuMTM1Mjg2IDcuNzIyNzQgMC45MTQ0NTNMNS44OTA5NiA0LjYyNjE4TDEuNzk0NyA1LjIyMTIzQzAuOTM0NzQyIDUuMzQ1NTMgMC41OTA2MDQgNi40MDM1OCAxLjIxMzYzIDcuMDEwMjlMNC4xNzcyNiA5Ljg5OTM0TDMuNDc4MSAxMy45Nzc3QzMuMzMwNTEgMTQuODM1NCA0LjIzMDA4IDE1LjQ4ODcgNC45OTkxNSAxNS4wODM5TDguNjYyNzEgMTMuMTU3NEwxMi4zMjYzIDE1LjA4MzlDMTMuMDk1MyAxNS40ODc5IDEzLjk5NDkgMTQuODM1NCAxMy44NDgxIDEzLjk3ODVMMTMuMTQ4OSA5Ljg5OTM0TDE2LjExMjYgNy4wMDk1MUMxNi43MzQgNi40MDM1OCAxNi4zOTE1IDUuMzQ2MyAxNS41MzA3IDUuMjIxMjNMMTEuNDM2IDQuNjI2MThMOS42MDM0NiAwLjkxNDQ1M1pNMC4yNDQ5MTIgMS40NDE5MkMwLjE0ODUwMSAxLjU2MjY2IDAuMTAzOTk2IDEuNzE2NzUgMC4xMjExODYgMS44NzAzQzAuMTM4Mzc3IDIuMDIzODUgMC4yMTU4NTUgMi4xNjQyOCAwLjMzNjU3OSAyLjI2MDcxTDIuMjc4NjcgMy44MTQzOEMyLjMzODIxIDMuODYzODggMi40MDcwMiAzLjkwMTAyIDIuNDgxMDggMy45MjM2MkMyLjU1NTE0IDMuOTQ2MjIgMi42MzI5NiAzLjk1MzgzIDIuNzA5OTkgMy45NDYwMUMyLjc4NzAzIDMuOTM4MTkgMi44NjE3MyAzLjkxNTA5IDIuOTI5NzMgMy44NzgwN0MyLjk5Nzc0IDMuODQxMDQgMy4wNTc2OCAzLjc5MDgzIDMuMTA2MDYgMy43MzAzOEMzLjE1NDQ0IDMuNjY5OTIgMy4xOTAyOCAzLjYwMDQyIDMuMjExNDkgMy41MjU5NkMzLjIzMjY5IDMuNDUxNDkgMy4yMzg4NSAzLjM3MzU0IDMuMjI5NTggMy4yOTY2NkMzLjIyMDMyIDMuMjE5NzkgMy4xOTU4MyAzLjE0NTUzIDMuMTU3NTMgMy4wNzgyM0MzLjExOTI0IDMuMDEwOTMgMy4wNjc5MiAyLjk1MTk0IDMuMDA2NTYgMi45MDQ3MUwxLjA2NDQ3IDEuMzUxMDNDMS4wMDQ3MiAxLjMwMzEzIDAuOTM2MTAxIDEuMjY3NDggMC44NjI1NTQgMS4yNDYxM0MwLjc4OTAwNiAxLjIyNDc3IDAuNzExOTY5IDEuMjE4MTIgMC42MzU4NDkgMS4yMjY1NkMwLjU1OTcyOSAxLjIzNSAwLjQ4NjAyMSAxLjI1ODM3IDAuNDE4OTQgMS4yOTUzMkMwLjM1MTg1OSAxLjMzMjI4IDAuMjkyNzIyIDEuMzgyMDkgMC4yNDQ5MTIgMS40NDE5MlpNMTcuMDgwNSAxMi42NTcxQzE3LjE3NyAxMi41MzY1IDE3LjIyMTYgMTIuMzgyNCAxNy4yMDQ2IDEyLjIyODlDMTcuMTg3NiAxMi4wNzU0IDE3LjExMDIgMTEuOTM0OSAxNi45ODk2IDExLjgzODNMMTUuMDQ3NSAxMC4yODQ2QzE0LjkyNjkgMTAuMTg4IDE0Ljc3MjggMTAuMTQzMyAxNC42MTkyIDEwLjE2MDJDMTQuNDY1NiAxMC4xNzcyIDE0LjMyNSAxMC4yNTQ1IDE0LjIyODQgMTAuMzc1MkMxNC4xMzE3IDEwLjQ5NTggMTQuMDg3IDEwLjY0OTkgMTQuMTAzOSAxMC44MDM1QzE0LjEyMDkgMTAuOTU3MSAxNC4xOTgyIDExLjA5NzcgMTQuMzE4OSAxMS4xOTQzTDE2LjI2MDkgMTIuNzQ4QzE2LjMyMDcgMTIuNzk1OSAxNi4zODkzIDEyLjgzMTUgMTYuNDYyOSAxMi44NTI5QzE2LjUzNjQgMTIuODc0MyAxNi42MTM0IDEyLjg4MDkgMTYuNjg5NiAxMi44NzI1QzE2Ljc2NTcgMTIuODY0IDE2LjgzOTQgMTIuODQwNyAxNi45MDY1IDEyLjgwMzdDMTYuOTczNiAxMi43NjY4IDE3LjAzMjcgMTIuNzE2OSAxNy4wODA1IDEyLjY1NzFaTTAuMzM2NTc5IDExLjgzODNDMC4yNzUyMjUgMTEuODg1NiAwLjIyMzkwMiAxMS45NDQ1IDAuMTg1NjA5IDEyLjAxMThDMC4xNDczMTcgMTIuMDc5MSAwLjEyMjgyMyAxMi4xNTM0IDAuMTEzNTYgMTIuMjMwM0MwLjEwNDI5NiAxMi4zMDcyIDAuMTEwNDQ5IDEyLjM4NTEgMC4xMzE2NTggMTIuNDU5NkMwLjE1Mjg2OCAxMi41MzQgMC4xODg3MDggMTIuNjAzNSAwLjIzNzA4NSAxMi42NjRDMC4yODU0NjEgMTIuNzI0NCAwLjM0NTQwNCAxMi43NzQ3IDAuNDEzNDA5IDEyLjgxMTdDMC40ODE0MTMgMTIuODQ4NyAwLjU1NjExNiAxMi44NzE4IDAuNjMzMTUgMTIuODc5NkMwLjcxMDE4NSAxMi44ODc0IDAuNzg4MDA2IDEyLjg3OTggMC44NjIwNjQgMTIuODU3MkMwLjkzNjEyMyAxMi44MzQ2IDEuMDA0OTMgMTIuNzk3NSAxLjA2NDQ3IDEyLjc0OEwzLjAwNjU2IDExLjE5NDNDMy4xMjM5MyAxMS4wOTY3IDMuMTk4MzIgMTAuOTU3IDMuMjEzNzQgMTAuODA1MkMzLjIyOTE2IDEwLjY1MzMgMy4xODQzNyAxMC41MDE1IDMuMDg5MDEgMTAuMzgyM0MyLjk5MzY1IDEwLjI2MzEgMi44NTUzMyAxMC4xODYxIDIuNzAzOCAxMC4xNjc5QzIuNTUyMjYgMTAuMTQ5NiAyLjM5OTYxIDEwLjE5MTUgMi4yNzg2NyAxMC4yODQ2TDAuMzM2NTc5IDExLjgzODNaTTE3LjA4MDUgMS40NDExNUMxNy4xNzcgMS41NjE3OSAxNy4yMjE2IDEuNzE1ODIgMTcuMjA0NiAxLjg2OTM2QzE3LjE4NzYgMi4wMjI5IDE3LjExMDIgMi4xNjMzOSAxNi45ODk2IDIuMjU5OTNMMTUuMDQ3NSAzLjgxMzYxQzE0Ljk4NzggMy44NjE0NSAxNC45MTkyIDMuODk3MDYgMTQuODQ1NyAzLjkxODQxQzE0Ljc3MjIgMy45Mzk3NSAxNC42OTUzIDMuOTQ2NDEgMTQuNjE5MiAzLjkzODAxQzE0LjU0MzEgMy45Mjk2MSAxNC40Njk1IDMuOTA2MyAxNC40MDI0IDMuODY5NDNDMTQuMzM1MyAzLjgzMjU2IDE0LjI3NjIgMy43ODI4MyAxNC4yMjg0IDMuNzIzMUMxNC4xODA1IDMuNjYzMzcgMTQuMTQ0OSAzLjU5NDggMTQuMTIzNiAzLjUyMTMxQzE0LjEwMjIgMy40NDc4MiAxNC4wOTU1IDMuMzcwODQgMTQuMTAzOSAzLjI5NDc3QzE0LjExMjQgMy4yMTg3MSAxNC4xMzU3IDMuMTQ1MDQgMTQuMTcyNSAzLjA3Nzk4QzE0LjIwOTQgMy4wMTA5MiAxNC4yNTkxIDIuOTUxNzggMTQuMzE4OSAyLjkwMzkzTDE2LjI2MDkgMS4zNTAyNkMxNi4zMjA3IDEuMzAyMzYgMTYuMzg5MyAxLjI2NjcxIDE2LjQ2MjkgMS4yNDUzNUMxNi41MzY0IDEuMjIzOTkgMTYuNjEzNCAxLjIxNzM0IDE2LjY4OTYgMS4yMjU3OEMxNi43NjU3IDEuMjM0MjIgMTYuODM5NCAxLjI1NzU5IDE2LjkwNjUgMS4yOTQ1NUMxNi45NzM2IDEuMzMxNSAxNy4wMzI3IDEuMzgxMzIgMTcuMDgwNSAxLjQ0MTE1WiIgZmlsbD0iI0U4NjA0QyIvPgo8L3N2Zz4K) !important;
        background-size: 100%;
    }
</style>

<div class="container" style="padding-top:4%">
        <div class="row ">
            <div class="col-12 col-lg-8 mx-auto card my-4">
                <div class="card-body py-5">
                    <div class="alert alert-success mt-3">
                        <h2 class="text-center fw-600 text-capitalize mt-2" >Review Submitted Successfully</h2>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
</div>




