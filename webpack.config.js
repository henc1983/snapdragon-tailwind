const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const isProduction = process.env.NODE_ENV === 'production';
const mode = isProduction ? 'production' : 'development';


const config = {
    mode,
    watch: true,
    resolve: {
        extensions: [".*", ".js", ".jsx"]
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 1
                        }
                    },
                    'postcss-loader',
                    'sass-loader',
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/fonts',
            }
        ]
    },
    plugins: [new MiniCssExtractPlugin(
        {
            filename: isProduction ? "../styles/[name].min.css" : "../styles/[name].css"
        }
    )],
    output: {
        filename: isProduction ? "[name].min.js" : "[name].js",
        path: path.resolve(__dirname, 'assets/scripts')
    }
};



const contentConfig = Object.assign({}, config, {
    name: "content",
    entry: {
        'main': [ './src/scripts/main.js' ],
    }
});



const adminConfig = Object.assign({}, config, {
    name: "admin",
    entry: {
        'admin': [ './src/scripts/admin.js' ],
    }
});


module.exports = (env) => {
	switch(true) {
		case env.admin:
			return contentConfig;
		case env.content:
			return adminConfig;
		default:
			return [ contentConfig , adminConfig ];
	}
};