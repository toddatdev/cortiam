<link href="http://fonts.cdnfonts.com/css/campton" rel="stylesheet">
<style>
    body {
        background-color: #ffffff;
    }

    .meet-agent-heading {
        font-weight: 700;
        font-size: 32px;
        color: #002C77;
    }

    .meet-agent-text {
        font-weight: 400;
        font-size: 18px;
        color: #9B9B9B;
    }

    .ribbon-top-right {
        top: -1px;
        right: -1px;
    }

    .ribbon {
        width: 140px;
        height: 140px;
        overflow: hidden;
        position: absolute;
        z-index: 10;
    }

    .ribbon-top-right::before {
        top: 0;
        left: 0;
    }
    .ribbon-top-right::before, .ribbon-top-right::after {
        border-top-color: transparent;
        border-left-color: transparent;
    }

    .ribbon::before, .ribbon::after {
        position: absolute;
        z-index: -1;
        content: '';
        display: block;
    }

    .ribbonyellow span {
        background-color: #002C77;
        color: #ffffff;
    }

    .ribbon-top-right span {
        left: -17px;
        top: 30px;
        transform: rotate(45deg);
    }

    .ribbon span {
        position: absolute;
        display: block;
        width: 225px;
        padding: 4px 0;
        background-color: #002C77;
        box-shadow: 0 5px 10px rgb(0 0 0 / 10%);
        color: #fff;
        font-size: .85rem;
        text-shadow: 0 1px 1px rgb(0 0 0 / 20%);
        text-transform: uppercase;
        text-align: center;
    }

    .ribbon-top-right::after {
        bottom: 0;
        right: 0;
    }

    .ribbon-top-right::before, .ribbon-top-right::after {
        border-top-color: transparent;
        border-left-color: transparent;
    }

    .ribbon::before, .ribbon::after {
        position: absolute;
        z-index: -1;
        content: '';
        display: block;
    }

    .findagent-search {

    }

    @media only screen and (min-width: 1200px) {
        .findagent.jumbotron {
            padding: 7.8rem 2rem 5.5rem 2rem !Important;
        }
    }

    .form-shadow {
        box-shadow: 0px 11px 24px rgba(119, 119, 119, 0.1);
    }
    @media only screen and (max-width: 1200px){
        .findagent.jumbotron {
            padding:7rem 2rem 6rem 2rem !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        body {
            margin-top: 44px !important;
        }
        .findagent.jumbotron {
            padding: 4rem 2rem 5.5rem 2rem !Important;
        }
    }
    @media only screen and (min-width:430px) and (max-width: 576px){
        .findagent.jumbotron .headline {
            font-size: 35px !important;
        }

    }
    @media only screen and (max-width: 430px){
        .findagent.jumbotron {
            padding: 4rem 2rem 5rem 2rem !Important;
        }
    }
    @media only screen and (max-width: 375px) {
        .findagent.jumbotron {
            padding: 3rem 2rem 4.5rem 2rem !Important;
        }
    }
</style>
<main role="main">
    <div class="findagent jumbotron jumbotron-fluid mb-0">
        <div class="container">
            <h1 class="headline mb-0">Agents on cortiam</h1>
            <div class="lead text-uppercase mb-0">Meet multiple agents from various brokerages.</div>
            <br>
        </div>
    </div>


    <div class="container findagent-search" style="box-shadow: 0px 36.7647px 73.5294px -18.3824px rgba(67, 67, 67, 0.15);">
        <div class="container-fluid">
            <form method="POST" class="search-form">
                <div class="row justify-content-between agent-state">
                    <div class="col-md-4 pb-2 pb-md-0 text-left">
                        <label class="text-dark-blue">Agent’s State</label>
                        <input type="text" class=" select-color" name="state" id="state" placeholder="State">
                    </div>
                    <div class="col-md-3 pb-2 pb-md-0 text-left">
                        <label class="text-dark-blue">Agent’s City</label>
                        <input type="text" name="city" id="city" placeholder="City">
                    </div>

         
                    <div class="col-md-3 pb-2 pb-md-0">
                        <label class="text-dark-blue">Zip Code</label>
                        <input class="pt-1" type="text" name="zipcode" id="zipcode" placeholder="Zip Code">
                    </div>
                    <div class="col-md-2 pb-2 pb-md-0 d-flex align-items-end pr-0">
                        <input type="button" class="button-search" value="Search Now"
                               id="searchbuyeragent">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="findagent-list">
        <div class="container">
            <div class="row px-3 px-md-5">
                <div class="col-md-8 mx-auto text-center">
                    <h3 class="meet-agent-heading campton-bold mb-0">Meet Your Agents</h3>
                    <p class="mb-3 meet-agent-text text-capitalize">Get to know your agent before you choose them. </p>
                </div>

            </div>
            <div class="row justify-content-center mt-5" id="findbuyeragenthtml" style="word-break: break-word">

            </div>
        </div>
    </div>
</main>
