//
//  Parmesan.swift
//  Hackathon Ordering App
//
//  Created by Laura Liu on 12/3/16.
//  Copyright © 2016 Laura Liu. All rights reserved.
//

import UIKit

class Parmesan: UIViewController {

    
    @IBOutlet var quantity: UILabel!
    
    
    /* @IBAction func add(sender: UIStepper) {
        quantity.text = "Quantity: \(String(sender.value)))"
    } */
    
    @IBAction func Action(sender: UIStepper) {
        quantity.text = String(sender.value)
    }
    
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
