<?php
return [	
		//应用ID,您的APPID。
		'app_id' => "2016092500596007",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEApTj9wCg4iXHP7uYjsG462fDBJhMLbIwkxk58/ypU9Xy4pfRYnjOQP1tpvWl6Ji2L+Xt/ONzD8uMMv4R0w//MfqypnboJlbyKG4LClMo/6eQkVHXFngdqsVzZrkMAfAoXGLKnckGJDcP4t5jpD8kLnj7xU0RhJm4nIyC9TZOIuN5D5ANRKKrQ/mTHLJImB+Nebver98sQ01mkl6kQqjDHHss4Y+saGoX/wy8OIx8njpHcqfFM/pAy7i8+pGjKOa79VSFcBbz84vQyJf7nZfbPDJB2R/CGPRjR9Yaad0o0Chfh+UVcMLQ2aDHPYVpNbn+OqU6qKfUSMEawvOJYU+uz2wIDAQABAoIBABdklVDioPac3aLmhMETKlP3KXG5mpF42jAVps798F99lCszCGUFyfOefr8psvi61CmzmZS0dS3rhb+MAnhJvGtnCPDjCT5hHnC8t84XQKtd+OLYde1lAW8xRUTOCcCGMTT2/oxHyR7g01MzXDQ28+Uo5kQy10p4qCPqG8NjEyWRYFnohfvWVp4aMoPQEf/9YOGYn2wOaHsjLomlSKNzv+QrhmdfKRQaV4eV5e0TcV/aD8nM1YT0SmAPoblzsHL4YITuQZcPdrPE5zsCWxewNRzVqVexpxDTvAum7hzdKMMBVimO4DIBrwY5+caT68ApGkFCXH/orAC2K2xTc9QzwgECgYEA2Uu/5MjibIlf9owFIma4xIarjda788z7Nz8hLpw77vWBbDGyXHs+zDgPUDCNPpyElPLxOJMyIUHENSKIafX+14fkzWW0msWrAsM97eEwmHrW9BP128Awt8qRyFHajdQEFvqo7TehNeg7ssHkQykBOokXtfNsR6GY7KVFCTIKetsCgYEAwqbOa6yqOZJEuNhR7F7Gwm/GHdWiiP5utrXQkprfChmUG2hWByrsRw0OpnE4wcLAgmadqQxT9lm7r6y2B4T4CBRlLn7li2/CxUe6Uqh3ZXg9DIZ/n/aUl+GKzVn1W1RlJhjR2lpwlWawjzaMPYeoCDDATK8fNbsQpFLL9UiuewECgYEAyOnVQADN+nT6mcfVZ317EZtDPB50InRBQ0/HqoUilUvCovtAY2pBIiojXo3Fy0KFBAOtLhZLn5xjgo2ve+nL/BTWZWPIneJuwFsuA6jXeeT6oythhBIr+YP/Tyz/22tRbL3PO6bYFDPqHtpP6Bkd3bWsirvMPl8YOpaFQn9WWUkCgYEAvgxFEGYWEX3ZMSyr1/+1ShP9uBVkyyK4EBY2XV1ulRriO1xEWl0zMi/ydNmo062FbgwotOu/cpCsKlqTo4XU8XaQT7RABEMLRLjCl3+6i0y5Nmh/ZTxIWn4wmkzRvOkKlQa4pduVfpkzm7BjfpPboJuQtY5qB3jsR7Q7RPJAwQECgYBPmx9fjjC2M3T8RWen70jGouUL3Ysj62bGDwCR2YoAB+egThJyJKgOrB8Ng9slROYNybSH234GLWY3OwD0jpyskxL4PD/HQAN3Tedu6PWleGeux+O+TAIs6Qt7Sztv54T2aDLaX/z3Tv/+R2J8R2geWtM3AOTax35UG/9YwUFIwA==",
		
		//异步通知地址
		'notify_url' => "http://alipay/notify",
		
		//同步跳转
		'return_url' => "http://alipay/return",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",
		
	
];