// Based on  https://codepen.io/diguifi/pen/YdBbyz
var canvasElement = document.getElementById("canvas");

var dd = {


 
  
	content: [
	    // Header
	    {
	        columns: [
	            {
                    image: 'data:image/jpeg;base64,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KBcNZ8b6BPyoJ6BWUWngazT9W32uW4wsCJn9XzfMivYek1yZ11B+2tlKuuTKg53wz2o+VzINBB1mtTPvUJaWHFToOmVBPeMlr6jSadcL5KneHvjSqtYpmVw2mr1lTbZ9CKyXFz83invPOdPZQypUW8PvM2uG012pqrXPoRSluneZD5qK7WahO5pDWEzinv5XefQigAAAAAAIlfc1vm9HgMdwAAAHpxa6Z+n09XkDqkqrWq3hKiyq5ph5tAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIMO68MN6t3x5/QAAJHee8w9niCuAUlXr/mk5GTpR9GdAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAc1toi6ROheX1fD7NdW3n7eryBrmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8fZztZJlIsNMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//aAAwDAQACAAMAAAAh888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888b288888888888883+3+t888888888888888888887999995/8APPPPPPPPPPPPPPNPnPPPPPPPPPPPPPPPf+/rPPPPPPPPPPPPPPPPPPPPbvvfffffPPNeeNOfPO/9/wD/AP7c881wz8885838889/ofN815/8/wDPPN/PfPPPPPO/rvfffffXPPPudPbWPK/Q/VPf/PLXff3/ACV339rzz3/z37xfr333Xy1/3/8A8888885oV999+Oc08+9Mswt+r9/5V9/8h9uM1dj9mP8AK/PPf/PfvF+51/db38/d/wDXzzzzzXXz332zhlLz6lzyz3Wv2zzz3/zWtzzzxX1/+z1Xz3/z37xe3yr1Xn37+71/zzzzy0yz3g7+16nz7/8A8h9fr9V889/8/vd8/wDOvfvffX/Pf/PfvF/fKvVb/VfffX/PPPPPzznDffvvrFvvXHf+f6/VfPPf/KvfvLebtzLvuPPPf/PfvF/fKvVf/bVH/dPPPPPPPI/vvvvvpPPvXPMXPKslvPMMvPHOsq3fHvuubPMcve8t/GNPLsnfD38urfPPPPPPPG/vvvvoXvPvfPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPLKtvvvvfPJXvPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPHO+t/PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPLPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP/aAAwDAQACAAMAAAAQ88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888/K38888888888888ww9/wDFfPPPPPPPPPPPPPPPPPPP/wDf/f8A7988888888888888889+8888888888888CAU+9/8888888888888888888sfBAAAAQ08842+3+889w981wi88823388867988CAU6yE861zz188877x888888+xxxAAAAAV88DHiAAF8rAqA9oC86DAASa4BAABe8CAU/AX8qUjABV82iASQ888888yHDAATvL7e8DAd/lA/rAGD9oC8qAEvJ+tAncCH0CAU/AX8qF9BA08CN+JCe88888oNOAAQ67ZY8DD88oA8rAH88oC8oU8888JASxCA2CAU/AX8qW88AWoAxxhA188886QASAJUevd48DC38uA1rAf88oC8JC9858gA/wDPPPQgFPwF/KlPPQFvQN/PPHPPPPLHzDzTfbvfbPwwAgQB/wCsD/zygLwwBBCHy8IFvOXwIBT8BfypTz0Bb2kF2tTzzzzzzzz7333332/wMGEIrXyoHXzyIHzzwsI67xwUIK3wQFToFXyNLz8Ffwwood/zzzzzzzzv33333l/wMHzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzyjb33n/zyx3zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz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',
                    width: 150
	            },
	                
	            [
	                {
	                    text: 'Price Catalog', 
	                    style: 'invoiceTitle',
	                    width: '*'
	                },
    	            {
    	              stack: [
    	                   {
    	                       columns: [
    	                            {
    	                                text:'Catalog #', 
    	                                style:'invoiceSubTitle',
    	                                width: '*'
    	                                
    	                            }, 
    	                            {
    	                                text:'00001',
    	                                style:'invoiceSubValue',
    	                                width: 100
    	                                
    	                            }
    	                            ]
    	                   },
    	                   {
    	                       columns: [
    	                           {
    	                               text:'Date Issued',
    	                               style:'invoiceSubTitle',
    	                               width: '*'
    	                           }, 
    	                           {
    	                               text:'June 01, 2022',
    	                               style:'invoiceSubValue',
    	                               width: 100
    	                           }
    	                           ]
    	                   },
    	                   {
    	                       columns: [
    	                           {
    	                               text:'Due Date',
    	                               style:'invoiceSubTitle',
    	                               width: '*'
    	                           }, 
    	                           {
    	                               text:'June 05, 2022',
    	                               style:'invoiceSubValue',
    	                               width: 100
    	                           }
    	                           ]
    	                   },
    	               ]
    	            }
	            ],
	        ],
	    },
	    // Billing Headers
	 
	    // Billing Details

	    // Billing Address Title
	
	    // Billing Address
	
        // Line breaks
	    '\n\n',
	    // Items
        {
          table: {
            // headers are automatically repeated if the table spans over multiple pages
            // you can declare how many rows should be treated as headers
            headerRows: 1,
            widths: [ '*', 40, 'auto', 40, 'auto', 80 ],
    
            body: [
              // Table Header
              [ 
                  {
                      text: 'Product',
                      style: 'itemsHeader'
                  }, 
                  {
                      text: 'Qty',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Price',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Tax',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Discount',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Total',
                      style: [ 'itemsHeader', 'center']
                  } 
              ],
              // Items
              // Item 1
              [ 
                  [
                      {
                          text: 'Item 1',
                          style:'itemTitle'
                      },
                      {
                          text: 'Item Description',
                          style:'itemSubTitle'
                          
                      }
                  ], 
                  {
                      text:'1',
                      style:'itemNumber'
                  }, 
                  {
                      text:'$999.99',
                      style:'itemNumber'
                  }, 
                  {
                      text:'0%',
                      style:'itemNumber'
                  }, 
                  {
                      text: '0%',
                      style:'itemNumber'
                  },
                  {
                      text: '$999.99',
                      style:'itemTotal'
                  } 
              ],
              // Item 2
              [ 
                  [
                      {
                          text: 'Item 2',
                          style:'itemTitle'
                      }, 
                      {
                          text: 'Item Description',
                          style:'itemSubTitle'
                          
                      }
                  ], 
                  {
                      text:'1',
                      style:'itemNumber'
                  }, 
                  {
                      text:'$999.99',
                      style:'itemNumber'
                  }, 
                  {
                      text:'0%',
                      style:'itemNumber'
                  }, 
                  {
                      text: '0%',
                      style:'itemNumber'
                  },
                  {
                      text: '$999.99',
                      style:'itemTotal'
                  } 
              ],
              // END Items
            ]
          }, // table
        //  layout: 'lightHorizontalLines'
        },
     // TOTAL
        {
          table: {
            // headers are automatically repeated if the table spans over multiple pages
            // you can declare how many rows should be treated as headers
            headerRows: 0,
            widths: [ '*', 80 ],
    
            body: [
              // Total
              [ 
                  {
                      text:'Subtotal',
                      style:'itemsFooterSubTitle'
                  }, 
                  { 
                      text:'$2000.00',
                      style:'itemsFooterSubValue'
                  }
              ],
              [ 
                  {
                      text:'Tax 21%',
                      style:'itemsFooterSubTitle'
                  },
                  {
                      text: '$523.13',
                      style:'itemsFooterSubValue'
                  }
              ],
              [ 
                  {
                      text:'TOTAL',
                      style:'itemsFooterTotalTitle'
                  }, 
                  {
                      text: '$2523.93',
                      style:'itemsFooterTotalValue'
                  }
              ],
            ]
          }, // table
          layout: 'lightHorizontalLines'
        },
	    // Signature
	    {
	        columns: [
	            {
	                text:'',
	            },
	            {
	                stack: [
	                    { 
	                        text: '',
	                        style:'signaturePlaceholder'
	                    },
	                 
	                    { 
	                        text: '',
	                        style:'signatureJobTitle'
	                        
	                    }
	                    ],
	               width: 180
	            },
	        ]
	    },
        { 
            text: 'NOTES',
            style:'notesTitle'
        },
        { 
            text: 'Please note pricing is subject to change.',
            style:'notesText'
        }
	],
	styles: {
	    // Document Header
	    documentHeaderLeft: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'left'
	    },
	    documentHeaderCenter: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'center'
	    },
	    documentHeaderRight: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'right'
	    },
	    // Document Footer
	    documentFooterLeft: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'left'
	    },
	    documentFooterCenter: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'center'
	    },
	    documentFooterRight: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'right'
	    },
	    // Invoice Title
		invoiceTitle: {
			fontSize: 22,
			bold: true,
			alignment:'right',
			margin:[0,0,0,15]
		},
		// Invoice Details
		invoiceSubTitle: {
			fontSize: 12,
			alignment:'right'
		},
		invoiceSubValue: {
			fontSize: 12,
			alignment:'right'
		},
		// Billing Headers
		invoiceBillingTitle: {
			fontSize: 14,
			bold: true,
			alignment:'left',
			margin:[0,20,0,5],
		},
		// Billing Details
		invoiceBillingDetails: {
			alignment:'left'

		},
		invoiceBillingAddressTitle: {
		    margin: [0,7,0,3],
		    bold: true
		},
		invoiceBillingAddress: {
		    
		},
		// Items Header
		itemsHeader: {
		    margin: [0,5,0,5],
		    bold: true
		},
		// Item Title
		itemTitle: {
		    bold: true,
		},
		itemSubTitle: {
            italics: true,
            fontSize: 11
		},
		itemNumber: {
		    margin: [0,5,0,5],
		    alignment: 'center',
		},
		itemTotal: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment: 'center',
		},

		// Items Footer (Subtotal, Total, Tax, etc)
		itemsFooterSubTitle: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'right',
		},
		itemsFooterSubValue: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'center',
		},
		itemsFooterTotalTitle: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'right',
		},
		itemsFooterTotalValue: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'center',
		},
		signaturePlaceholder: {
		    margin: [0,70,0,0],   
		},
		signatureName: {
		    bold: true,
		    alignment:'center',
		},
		signatureJobTitle: {
		    italics: true,
		    fontSize: 10,
		    alignment:'center',
		},
		notesTitle: {
		  fontSize: 10,
		  bold: true,  
		  margin: [0,50,0,3],
		},
		notesText: {
		  fontSize: 10
		},
		center: {
		    alignment:'center',
		},
	},
	defaultStyle: {
		columnGap: 20,
	}
}

var docDefinition = {
    content: [
        {
            alignment: "center",
            text: "PPRA",
            style: "header",
            fontSize: 23,
            bold: true,
            margin: [0, 10]
        },
        {
            margin: [0, 0, 0, 10],
            layout: {
                fillColor: function(rowIndex, node, columnIndex) {
                    return rowIndex % 2 === 0 ? "#ebebeb" : "#f5f5f5";
                }
            },
            table: {
                widths: ["100%"],
                heights: [20, 10],
                body: [
                    [
                        {
                            text: "SETOR: ADMINISTRATIVO",
                            fontSize: 9,
                            bold: true
                        }
                    ],
                    [
                        {
                            text: "FUNÇÃO: DIRETOR DE ENSINO",
                            fontSize: 9,
                            bold: true
                        }
                    ]
                ]
            }
        },
        {
            style: "tableExample",
            layout: {
                fillColor: function(rowIndex, node, columnIndex) {
                    return rowIndex === 0 ? "#c2dec2" : null;
                }
            },
            table: {
                widths: ["30%", "10%", "25%", "35%"],
                heights: [10, 10, 10, 10, 30, 10, 25],
                headerRows: 1,
                body: [
                    [
                        {
                            text: "AGENTE: Não Identificados",
                            colSpan: 3,
                            bold: true,
                            fontSize: 9
                        },
                        {},
                        {},
                        {
                            text: "GRUPO: Grupo 1 - Riscos Físicos",
                            fontSize: 9,
                            bold: true
                        }
                    ],
                    [
                        {
                            text: "Limite de Tolerância:",
                            fontSize: 9,
                            bold: true
                        },
                        {
                            text: "Meio de Propagação:",
                            colSpan: 3,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {}
                    ],
                    [
                        {
                            text: [
                                "Frequência: ",
                                {
                                    text: "Habitual",
                                    bold: false
                                }
                            ],
                            fontSize: 9,
                            bold: true
                        },
                        {
                            text: [
                                "Classificação do Efeito: ",
                                {
                                    text: "Leve",
                                    bold: false
                                }
                            ],
                            colSpan: 3,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {}
                    ],
                    [
                        {
                            text: "Tempo de Exposição:",
                            colSpan: 2,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {
                            text: "Medição:",
                            colSpan: 2,
                            fontSize: 9,
                            bold: true
                        },
                        {}
                    ],
                    [
                        {
                            text: "Fonte Geradora:",
                            border: [true, true, false, false],
                            colSpan: 2,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {
                            text: "Téc. Utilizada:",
                            border: [false, true, true, false],
                            colSpan: 2,
                            fontSize: 9,
                            bold: true
                        },
                        {}
                    ],
                    [
                        {
                            text: "Conclusão:",
                            border: [true, false, true, true],
                            colSpan: 4,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {},
                        {}
                    ],
                    [
                        {
                            text: "EPIs/EPCs:",
                            border: [true, true, false, true],
                            colSpan: 3,
                            fontSize: 9,
                            bold: true
                        },
                        {},
                        {},
                        {
                            text: "CAs:",
                            border: [false, true, true, true],
                            fontSize: 9,
                            bold: true
                        }
                    ]
                ]
            }
        }
    ]
};

// let docDef = dd;
// let docDef = docDefinition;

function render() {
    pdfMake.createPdf(dd).getDataUrl(function(dataURL) {
        renderPDF(dataURL, document.getElementById("canvas"));
    });
}
function download() {
    var pdf = createPdf(dd);
    pdf.download("PPRA.pdf");
}

// * this is not important for PDFMake, it's here just to render the result *
// It's a Mozilla lib called PDFjs that handles pdf rendering
function renderPDF(url, canvasContainer, options) {
    options = options || { scale: 1.4 };

    function renderPage(page) {
        var viewport = page.getViewport(options.scale);
        var wrapper = document.createElement("div");
        wrapper.className = "canvas-wrapper";
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext("2d");
        var renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };

        canvas.height = viewport.height;
        canvas.width = viewport.width;
        wrapper.appendChild(canvas);
        canvasContainer.appendChild(wrapper);

        page.render(renderContext);
    }

    function renderPages(pdfDoc) {
        for (var num = 1; num <= pdfDoc.numPages; num++)
            pdfDoc.getPage(num).then(renderPage);
    }

    PDFJS.disableWorker = true;
    PDFJS.getDocument(url).then(renderPages);
}
