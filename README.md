# Overwatch Counters

> Some enemy hero giving you trouble? Grab your favorite counter!\
> Overwatch Counters is available online at [overwatchcounters.com](https://overwatchcounters.com/).

![demo](/demo.gif)

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


## Use your own counter data

Tried the hosted version? Don't agree with our counter data? Want to use your own? Let's do it.

### Installation

1. `git clone`
1. `pnpm i`
1. Map `public_html` to a (sub)domain.

### Configuration

1. Copy `/app/config.example.php` to `/app/config.php`.
1. Edit `/app/config.php`.
1. Save a copy of [our Google Sheet](https://docs.google.com/spreadsheets/d/1v-zzhduSF6UUw-9SNDhAkL9gC4Mppk2SQ0L0gz0CWS0/edit?usp=sharing) to your own Drive.
1. `File`, `Publish to the web`, Select only page `1`, `Start publishing`.
1. Change the `Web page` select to `CSV`, copy the URL to your config.
1. Visit the (sub)domain.

## Contributing

Found a bug? Anything you would like to ask, add or change? Please open an issue so we can talk about it.

Pull requests are welcome. Please try to match the current code formatting.

### Development installation

See [Installation](#Installation).

### Build tools

Command | Minification | Sourcemaps | Continuous
:--- |:--- |:--- |:---
`pnpm gulp --env=prod` | :heavy_check_mark: | :heavy_minus_sign: | :heavy_minus_sign:
`pnpm gulp` | :heavy_minus_sign: | :heavy_check_mark: | :heavy_minus_sign:
`pnpm gulp watch` | :heavy_minus_sign: | :heavy_check_mark: | :heavy_check_mark:

## Author

[Tim Brugman](https://timbr.dev/)