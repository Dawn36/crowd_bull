@extends('layouts.main_website')

@section('contentWebsite')

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Ad Policy</h1>
            </div>
        </div>
    </div>
</section>

<section class="content-simple">
    <div class="container">
        <div class="row">
            <div class="col-md-9  matchheight">
                <div class="sec-padding clearfix">


                    <h4>What is Crypto Market Cap?</h4>
                    <p>Crypto market cap is the total value of all the coins of a particular cryptocurrency that have been mined or are in circulation. Market capitalization is used to determine the ranking of cryptocurrencies. The higher the market
                        cap of a particular crypto coin, the higher its ranking and share of the market. Crypto market cap is calculated by multiplying the total number of coins in circulation by its current price. For instance, to calculate the market
                        cap of Ethereum, all you need to do is multiply the total number of Ethereum in circulation by the current price of one Ethereum and you will get its market cap.</p>
                    <h5>
                        How to compare Cryptocurrencies Market Cap?
                    </h5>
                    <p>Crypto market cap can be divided into three categories:</p>
                    <ul>
                        <li>Large-cap cryptocurrencies (>$10 billion)</li>
                        <li>Mid-cap Cryptocurrencies ($1 billion - $10 billion)</li>
                        <li>Small-cap cryptocurrencies (
                            <$1 billion).</li>
                    </ul>
                    <p>As a financial metric, market cap allows you to compare the total circulating value of one cryptocurrency with another. Large cap cryptocurrencies such as Bitcoin and Ethereum have a market cap of over $10 billion. They typically
                        consist of protocols that have demonstrated track records, and have a vibrant ecosystem of developers maintaining and enhancing the protocol, as well as building new projects on top of them. While market cap is a simple and
                        intuitive comparison metric, it is not a perfect point of comparison. Some cryptocurrency projects may appear to have inflated market cap through price swings and the tokenomics of their supply. As such, it is best to use this
                        metric as a reference alongside other metrics such as trading volume, liquidity, fully diluted valuation, and fundamentals during your research process.</p>
                    <h5>
                        How does CoinGecko Calculate Cryptocurrency Prices?
                    </h5>
                    <p>The price is calculated using a global volume-weighted average price formula which is based on the pairings available on different exchanges of a particular crypto asset. For examples and more detailed information on how we track
                        cryptocurrency prices and other metrics, see our methodology page here.</p>
                    <h5>
                        Why are Cryptocurrency Prices Different on Exchanges?
                    </h5>
                    <p>You may notice that cryptocurrencies listed on different exchanges have different prices. The reasons for this are complex, but simply put cryptocurrencies are traded on different exchanges and across different markets with varying
                        economic conditions, liquidity, trading pairs, and offerings (e.g. derivatives / leverage) which all influence price in their own way.</p>
                </div>
            </div>
            <div class="col-md-3 matchheight">
                <div class="inner sec-padding plpx-30 bg-silver h-100">


                    <ul>
                        <li><a href="{{route('about-us')}}">About us</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('ad-policy')}}">Ad Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection('contentWebsite')