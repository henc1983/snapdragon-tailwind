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
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: () => [
                                    require('autoprefixer')
                                ]
                            }
                        }
                    },
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



const content = Object.assign({}, config, {
    name: "content",
    entry: {
        'main': [ './src/scripts/main.js' ],
    }, 
});



const admin = Object.assign({}, config, {
    name: "admin",
    entry: {
        'main': [ './src/scripts/admin.js' ],
    }, 
});


module.exports = (env) => {
	switch(true) {
		case env.admin:
			return admin;
		case env.content:
			return content;
		default:
			return [ content, admin ];
	}
};